<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Products;
use App\Models\offers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function shop()
    {

        $today = Carbon::today();

        // Expire discounts where end_date passed
        DB::table('discounts')
            ->whereNotNull('end_date')
            ->where('end_date', '<', $today)
            ->where('status', '!=', 'inactive')
            ->update([
                'status' => 'inactive',
                'updated_at' => $today,
            ]);

        // Activate discounts where start_date has arrived (and no end_date OR end_date >= today)
        DB::table('discounts')
            ->whereNotNull('start_date')
            ->where('start_date', '<=', $today)
            ->where(function ($query) use ($today) {
                $query->whereNull('end_date')->orWhere('end_date', '>=', $today);
            })->where('status', '=', 'active');


        $products = DB::table('products')
            ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
            ->select(
                'products.*',
                'discounts.discount_type',
                'discounts.discount',
                'discounts.badge_text',
                'discounts.deal_tag',
                'discounts.feature_highlight as discount_feature_highlight',
                'discounts.start_date',
                'discounts.end_date',
                'discounts.status as discount_status',
            )->get();


        $offer = Offers::where('status', 'active')->orderBy('id', 'desc')->first();
        $brands = Brand::orderBy('name')->get();

        $rams = Products::select('ram')->distinct()->orderBy('ram')->pluck('ram');

        $priceRanges = [
            '5000-10000' => '₹5,000 - ₹10,000',
            '10000-20000' => '₹10,000 - ₹20,000',
            '20000-40000' => '₹20,000 - ₹40,000',
            '40000+' => 'Above ₹40,000',
        ];

        return view('shop', compact('brands', 'products', 'priceRanges', 'rams', 'offer'));
    }
}
