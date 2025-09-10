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
        $user = Session::get('user');

        if (!$user) {
            return redirect()->route('login')->with("error", "Please login to view cart.");
        }

        $carts = cart::with('product')
            ->where('user_id', $user->id)
            ->get();

        return view('add_to_cart', compact('carts'));
    }

    public function add_cart($id)
    {
        $product = Products::find($id);


        if ($product->stock_quantity > 0) {

            $user = Session::get('user')->id;
            $product_id = $product->id;

            $cartItem = Cart::where('user_id', $user)
                ->where('product_id', $product_id)
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
                $cart->user_id = $user;
                $cart->product_id = $product_id;
                $cart->save();
            }

            return redirect()->route('cart_detail')->with('success', 'Product added to cart. ✅');
        } else {
            return back()->with("error", "Stock not available...");
        }
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

    public function showCheckOut()
    {
        $user = Session::get('user');

        if (!$user) {
            return redirect()->route('login')->with("error", "Please login first...");
        }

        $cart_items = cart::where('user_id', $user->id)->get();

        if ($cart_items->isEmpty()) {
            return redirect()->route('cart.index')->with("error", "Your cart is empty!");
        }

        return view('checkout',compact('cart_items'));
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
