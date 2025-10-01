<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Products;
use App\Models\offers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        $today = Carbon::today();

        DB::table('discounts')
            ->whereNotNull('end_date')
            ->where('end_date', '<', $today)
            ->where('status', '!=', 'inactive')
            ->update([
                'status' => 'inactive',
                'updated_at' => $today,
            ]);

        DB::table('discounts')
            ->whereNotNull('start_date')
            ->where('start_date', '<=', $today)
            ->where(function ($query) use ($today) {
                $query->whereNull('end_date')->orWhere('end_date', '>=', $today);
            })->where('status', '=', 'active');

        $productsQuery = DB::table('products')
            ->leftJoin('discounts', 'products.id', '=', 'discounts.product_id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
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
                'brands.name as brand_name',
                DB::raw('AVG(reviews.rating) as avg_rating'),
                DB::raw('COUNT(reviews.id) as total_reviews')
            )
            ->where('products.status', 'active')
            ->groupBy(
                'products.id',
                'discounts.discount_type',
                'discounts.discount',
                'discounts.badge_text',
                'discounts.deal_tag',
                'discounts.feature_highlight',
                'discounts.start_date',
                'discounts.end_date',
                'discounts.status',
                'brands.name'
            )->where('products.status', 'active');


        if ($request->filled('price')) {
            $productsQuery->where(function ($query) use ($request) {
                foreach ($request->price as $range) {
                    if ($range === '100000+') {
                        $query->orWhere('products.price', '>=', 100000);
                    } elseif (strpos($range, '-') !== false) {
                        [$min, $max] = explode('-', $range);
                        $query->orWhereBetween('products.price', [(int) $min, (int) $max]);
                    }
                }
            });
        }


        if ($request->has('brand')) {
            $productsQuery->whereIn('products.brand_id', $request->brand);
        }

        if ($request->has('ram')) {
            $productsQuery->whereIn('products.ram', $request->ram);
        }

        if ($request->filled('rate')) {
            $minRating = min($request->rate);
            $productsQuery->where('reviews.rating', '>=', $minRating);
        }

        $products = $productsQuery->orderBy('products.created_at', 'desc')->get();

        $offer = Offers::where('status', 'active')->orderBy('id', 'desc')->first();

        $brands = Brand::orderBy('name')->get();
        $rams = Products::select('ram')->distinct()->orderBy('ram')->pluck('ram');

        $priceRanges = [
            '15000-40000' => '₹15,000 - ₹40,000',
            '40000-70000' => '₹40,000 - ₹70,000',
            '70000-100000' => '₹70,000 - ₹1,00,000',
            '100000+' => 'Above ₹1,00,000',
        ];

        return view('shop', compact('brands', 'products', 'priceRanges', 'rams', 'offer'));
    }

    public function search(Request $request)
    {

        $search = $request->input('query');

        $products = Products::where('name', 'LIKE', "%{$search}%")
            ->orWhere('color', 'LIKE', "%{$search}%")
            ->get();


        $offer = Offers::where('status', 'active')->orderBy('id', 'desc')->first();
        $brands = Brand::orderBy('name')->get();
        $rams = Products::select('ram')->distinct()->orderBy('ram')->pluck('ram');
        $priceRanges = [
            '15000-40000' => '₹15,000 - ₹40,000',
            '40000-70000' => '₹40,000 - ₹70,000',
            '70000-100000' => '₹70,000 - ₹1,00,000',
            '100000+' => 'Above ₹1,00,000',
        ];

        return view('shop', compact('products', 'brands', 'priceRanges', 'rams', 'offer'));

    }


}
