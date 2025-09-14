<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products;
use App\Models\Cart;
use App\Models\Discount;
use Razorpay\Api\Api;

class CheckoutController extends Controller
{

    public function showCheckout()
    {
        $userId = Session::get('user')->id;
        $cartItems = Cart::where('user_id', $userId)->get();

        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $product = Products::find($cartItem->product_id);
            if ($product) {
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
                $totalAmount += $finalPrice * $cartItem->quantity;
            }
        }


        $razorpayMax = 50000;
        if ($totalAmount > $razorpayMax) {
            return redirect()->route('cart_detail')->with(
                'error',
                'In test mode, maximum payable amount is ₹50,000. Please reduce cart amount.'
            );
        }

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $razorpayOrder = $api->order->create([
            'receipt' => 'order_rcptid_' . time(),
            'amount' => $totalAmount * 100,
            'currency' => 'INR',
        ]);

        return view('checkout', [
            'carts' => $cartItems,
            'totalAmount' => $totalAmount,
            'razorpayKeyId' => env('RAZORPAY_KEY_ID'),
            'razorpayOrderId' => $razorpayOrder['id'],
            'user' => Session::get('user'),
        ]);
    }


    public function processOrder(Request $request)
    {
        $userId = Session::get('user')->id;

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

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

            return redirect()->route('home')->with('success', 'Payment successful, Order placed!');

        } catch (\Exception $e) {
        \Log::error('Razorpay verification failed: ' . $e->getMessage(), [
            'order_id' => $request->razorpay_order_id,
            'payment_id' => $request->razorpay_payment_id,
            'signature' => $request->razorpay_signature
        ]);
            return redirect()->route('cart_detail')->with('error', 'Payment verification failed. Please try again.');
        }
    }

}
