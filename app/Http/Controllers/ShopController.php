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
                'discounts.status'
            )->where('products.status', 'active');


        if ($request->filled('price')) {
            $productsQuery->where(function ($query) use ($request) {
                foreach ($request->price as $range) {
                    if ($range === '40000+') {
                        $query->orWhere('products.price', '>=', 40000);
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
            '5000-10000' => '₹5,000 - ₹10,000',
            '10000-20000' => '₹10,000 - ₹20,000',
            '20000-40000' => '₹20,000 - ₹40,000',
            '40000+' => 'Above ₹40,000',
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
            '5000-10000' => '₹5,000 - ₹10,000',
            '10000-20000' => '₹10,000 - ₹20,000',
            '20000-40000' => '₹20,000 - ₹40,000',
            '40000+' => 'Above ₹40,000',
        ];

        return view('shop', compact('products', 'brands', 'priceRanges', 'rams', 'offer'));

    }


}
