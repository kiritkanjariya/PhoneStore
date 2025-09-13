<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products;
use App\Models\cart;
use App\Models\Discount;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $userId = Session::get('user')->id;

        $cartItems = Cart::where('user_id', $userId)->get();

        $items = [];
        $totalAmount = 0;

        foreach ($cartItems as $cartItem) {
            $product = Products::find($cartItem->product_id);

            if ($product && $product->stock_quantity >= $cartItem->quantity) {
                $today = now()->toDateString();
                $discount = Discount::where('product_id', $product->id)
                    ->where('status', 'active')
                    ->where(function ($q) use ($today) {
                        $q->whereNull('start_date')->orWhere('start_date', '<=', $today);
                    })
                    ->where(function ($q) use ($today) {
                        $q->whereNull('end_date')->orWhere('end_date', '>=', $today);
                    })
                    ->first();

                $finalPrice = $product->price;

                if ($discount) {
                    if ($discount->discount_type === 'percentage') {
                        $finalPrice -= ($product->price * $discount->discount) / 100;
                    } elseif ($discount->discount_type === 'fixed') {
                        $finalPrice -= $discount->discount;
                    }
                }

                $items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $cartItem->quantity,
                    'price' => $finalPrice,
                    'subtotal' => $finalPrice * $cartItem->quantity,
                ];

                $totalAmount += $finalPrice * $cartItem->quantity;

                $product->stock_quantity -= $cartItem->quantity;
                $product->save();
            }
        }


        $order = new orders();
        $order->user_id = $userId;
        $order->order_number = 'ORD' . now()->format('YmdHis') . rand(100, 999);
        $order->total_amount = $totalAmount;
        $order->order_status = 'pending';
        $order->items = json_encode($items);

        $order->shipping_name = $request->full_name;
        $order->shipping_address = $request->address;
        $order->shipping_phone = $request->phone;

        $order->save();

        Cart::where('user_id', $userId)->delete();

        // return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

}
