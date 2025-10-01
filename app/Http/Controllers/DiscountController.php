<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Discount;
use App\Models\Brand;
use App\Models\offers;
use App\Models\Products;
use Illuminate\Http\Request;

class DiscountController extends Controller
{

    public function redicrect_offers()
    {

        $offers = offers::all();
        $discounts = Discount::with('product')->get();
        return view('admin/admin_offers', compact('discounts', 'offers'));
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


    // Global Offers

    public function add_offer()
    {
        return view('admin/add_offer');
    }
    public function offer_added(Request $request)
    {
        $offer = new offers();
        $offer->title = $request->offer_title;
        $offer->code = $request->offer_code;
        $offer->min_amount = $request->min_amount;
        $offer->discount = $request->discount_percentage;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        $offer->status = $request->status;
        $offer->save();

        return redirect()->route('admin_offers')->with('success', 'Offer Added Successfully...');
    }
    public function edit_offer(Request $request, $id)
    {
        $offer = offers::where('id', $id)->firstOrFail();
        return view('admin/edit_offers', compact('offer'));
    }
    public function offer_updated(Request $request, $id)
    {
        $request->validate([
            'offer_code' => 'string|max:50',
            'discount_percentage' => 'numeric|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $offer = offers::findOrFail($id);
        $offer->title = $request->offer_title;
        $offer->code = $request->offer_code;
        $offer->min_amount = $request->min_amount;
        $offer->discount = $request->discount_percentage;
        $offer->start_date = $request->start_date;
        $offer->end_date = $request->end_date;
        $offer->status = $request->status;
        $offer->save();

        return redirect()->route('admin_offers')->with('success', 'Offer Updated Successfully...');
    }

    public function destory($id)
    {
        $offer = offers::findOrFail($id);
        $offer->delete();

        return redirect()->back()->with('success', 'Offer deleted successfully!');
    }


    // logic for apply coupon

    public function apply_coupon(Request $request)
    {
        if (!$request->has('code') || empty($request->code)) {
            return redirect()->route('Checkout')->with('error', 'Please enter a coupon code.');
        }
        $coupon_code = $request->code;
        $subtotal = $request->subtotal;

        $current_date = date('Y-m-d');

        offers::where('end_date', '<', $current_date)
            ->where('status', 'active')
            ->update([
                'status' => 'inactive'
            ]);


        $coupon = offers::where('code', $coupon_code)
            ->where('start_date', '<=', $current_date)
            ->where('end_date', '>=', $current_date)
            ->where(function ($query) {
                $query->where('status', 'inactive')
                    ->orWhere('status', 'active');
            })
            ->first();

        if ($coupon) {
            $coupon->status = 'active';
            $coupon->save();
        }



        if (!$coupon) {
            return redirect()->route('Checkout')->with('error', 'Invalid or expired coupon code.');
        }

        Session::forget(['appliedCoupon', 'discountAmount', 'newTotal']);

        $usedCoupons = Session::get('used_coupons', []);
        if (in_array($coupon->code, $usedCoupons)) {
            return redirect()->route('Checkout')->with('error', 'You have already used this coupon in this session.');
        }

        if ($subtotal < $coupon->min_amount) {
            return redirect()->route('Checkout')->with(
                'error',
                'This coupon requires a minimum order of ₹' . number_format($coupon->min_amount)
            );
        }

        if ($coupon->discount) {
            $discountAmount = $coupon->min_amount * ($coupon->discount / 100);
        } else {
            $discountAmount = $coupon->discount;
        }

        $newTotal = $subtotal - $discountAmount;

        Session::put('appliedCoupon', $coupon->code);
        Session::put('discountAmount', $discountAmount);
        Session::put('newTotal', $newTotal);

        Session::push('used_coupons', $coupon->code);


        if ($coupon) {
            return redirect()->route('Checkout')->with('success', 'Coupon applied successfully! You saved ₹' . number_format($discountAmount));
        } else {
            return redirect()->route('Checkout')->with('error', 'Failed to apply coupon. Please try again.');
        }

    }





}