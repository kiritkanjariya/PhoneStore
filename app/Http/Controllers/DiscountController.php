<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Brand;
use App\Models\Products;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function redicrect_offers()
    {
        $discounts = Discount::with('product')->get();
        return view('admin/admin_offers', compact('discounts'));
    }

    public function add_discount()
    {
        $products = Products::all();
        return view('admin/add_discount', compact('products'));
    }

    public function discount_added(Request $request)
    {
        $request->validate([

            'badge_text' => 'nullable|string|max:255|required_without_all:discount,deal_tag,feature_highlight',
            'discount_type' => 'nullable|required_with:discount',
            'discount' => 'nullable|numeric|',
            'deal_tag' => 'nullable|string|max:255|required_with:discount',
            'feature_highlight' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $discount = new Discount();
        $discount->product_id = $request->product_id;
        $discount->discount_type = $request->discount_type;
        $discount->discount = $request->discount;
        $discount->badge_text = $request->badge_text;
        $discount->deal_tag = $request->deal_tag;
        $discount->feature_highlight = $request->feature_highlight;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->status = $request->status;

        $discount->save();

        return redirect()->route('admin_offers')->with('success', 'discount added successfully!');

    }

    public function edit_discount($id)
    {

        $discount = Discount::where('id', $id)->firstOrFail();
        $products = Products::all();
        return view('admin/edit_discount', compact('discount', 'products'));
    }

    public function discount_updated(Request $request, $id)
    {
        $request->validate([
            'badge_text' => 'nullable|string|max:255|required_without_all:discount,deal_tag,feature_highlight',
            'discount_type' => 'nullable|required_with:discount',
            'discount' => 'nullable|numeric|',
            'deal_tag' => 'nullable|string|max:255|required_with:discount',
            'feature_highlight' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $discount = Discount::findOrFail($id);

        $discount->product_id = $request->product_id;
        $discount->discount_type = $request->discount_type;
        $discount->discount = $request->discount;
        $discount->badge_text = $request->badge_text;
        $discount->deal_tag = $request->deal_tag;
        $discount->feature_highlight = $request->feature_highlight;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->status = $request->status;

        $discount->save();

        return redirect()->route('admin_offers')->with('success', 'Discount updated successfully!');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->back()->with('success', 'Discount deleted successfully!');
    }



}