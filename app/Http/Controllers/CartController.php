<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cart()
    {
        Session::forget(['appliedCoupon', 'discountAmount', 'newTotal']);
        $user = Session::get('user');

        if (!$user) {
            return redirect()->route('login')->with("error", "Please login to view cart.");
        }

        $carts = Cart::with(['product.discount', 'product.brand'])
            ->where('user_id', $user->id)
            ->get();

        $subtotal = 0;
        $originalTotal = 0;
        $totalDiscount = 0;

        foreach ($carts as $cart) {
            $product = $cart->product;
            $discount = $product->discount ?? null;
            $price = floatval($product->price ?? 0);
            $finalPrice = $price;

            if ($discount && !empty($discount->discount)) {
                if ($discount->discount_type === 'percentage') {
                    $finalPrice = $price - ($price * (float) $discount->discount / 100);
                } else {
                    $finalPrice = $price - (float) $discount->discount;
                }
            }

            $lineTotal = $finalPrice * $cart->quantity;
            $originalLineTotal = $price * $cart->quantity;

            $subtotal += $lineTotal;
            $originalTotal += $originalLineTotal;
            $totalDiscount += ($originalLineTotal - $lineTotal);
        }

        return view('add_to_cart', compact('carts', 'subtotal', 'originalTotal', 'totalDiscount'));
    }


    public function add_cart($id)
    {
        $product = Products::findOrFail($id);

        $userId = Session::get('user')->id;

        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity < $product->stock_quantity) {
                $cartItem->quantity++;
                $cartItem->save();
            } else {
                return redirect()->route('cart_detail')->with('error', 'You already added maximum stock available ❌');
            }
        } else {
            $cart = new cart();
            $cart->user_id = $userId;
            $cart->product_id = $product->id;
            $cart->save();
        }

        return redirect()->route('cart_detail')->with('success', 'Product added to cart ✅');
    }


    public function increaseQuantity($id)
    {
        $cart = cart::findOrFail($id);
        $product = $cart->product;

        if ($cart->quantity < $product->stock_quantity) {
            $cart->quantity += 1;
            $cart->save();
            return back()->with('success', 'Quantity increased');
        } else {
            return back()->with('error', 'Stock not available...');
        }
    }


    public function decreaseQuantity($id)
    {
        $cart = cart::findOrFail($id);

        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->save();
        } else {
            $cart->delete();
            return back()->with('success', 'Item removed from cart');
        }

        return back()->with('success', 'Quantity decreased');
    }

    public function delete_cart_item($id)
    {
        $cart = cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart_detail')->with('error', 'Product Deleted to cart. ✅');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart)
    {
        //
    }
}
