<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Brand;
use App\Models\review;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsController extends Controller
{

    public function redicrect_product()
    {
        $products = Products::with('brand')->get();
        return view('admin/admin_product', compact('products'));
    }

    public function add_product()
    {
        $brands = Brand::all();
        return view('admin/add_product', compact('brands'));
    }
    public function product_added(Request $formdata)
    {
        $products = new Products();
        $products->name = $formdata->name;
        $products->price = $formdata->price;
        $products->ram = $formdata->ram;
        $products->storage = $formdata->storage;
        $products->color = $formdata->color;
        $products->screen_size = $formdata->screen_size;
        $products->feature_highlight = $formdata->feature_highlight;
        $products->stock_quantity = $formdata->stock;
        $products->brand_id = $formdata->brand;
        $products->status = $formdata->status;
        if ($formdata->hasFile('product_image')) {
            $file = $formdata->file('product_image');
            $originalName = $file->getClientOriginalName();
            $file->move(public_path('img\product-images'), $originalName);
            $products->image = $originalName;
        }
        $products->save();
        return redirect()->route('admin_product')->with('success', 'Product Added successfully ✅');
    }

    public function edit_product($id)
    {
        $brands = Brand::all();
        $products = Products::where('id', $id)->get();
        return view('admin/edit_product', compact('products', 'brands'));
    }

    public function product_updated(Request $request, $id)
    {
        $products = Products::findOrFail($id);

        $products->name = $request->name;
        $products->price = $request->price;
        $products->brand_id = $request->brand;
        $products->screen_size = $request->screen_size;
        $products->feature_highlight = $request->feature_highlight;
        $products->stock_quantity = $request->stock;
        $products->ram = $request->ram;
        $products->storage = $request->storage;
        $products->color = $request->color;
        $products->status = $request->status;

        if ($request->hasFile('product_image')) {
            if ($products->image && file_exists(public_path('img/product-images/' . $products->image))) {
                unlink(public_path('img/product-images/' . $products->image));
            }

            $file = $request->file('product_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/product-images/'), $filename);

            $products->image = $filename;
        }

        $products->save();

        return redirect()->route('admin_product')->with('success', 'Product Updated successfully ✅');
    }


    public function home()
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
            ->where('brands.name', 'Apple')
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
            )
            ->get();


        $sliders = Slider::where('status', 'active')->get();

        return view('index', compact('products', 'sliders'));
    }

    public function phone_details($id)
    {

        $product = DB::table('products')
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
            )
            ->where('brands.name', 'Apple')
            ->where('products.id', $id)
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
            )->first();

        $reviews = Review::with('user')
            ->where('product_id', $id)
            ->latest()
            ->get();

        return view('phone_detail', compact('product', 'reviews'));
    }


    public function destroy($id)
    {

        $product = Products::findOrFail($id);


        if ($product->image && file_exists(public_path('img/product-images/' . $product->image))) {
            unlink(public_path('img/product-images/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin_product')->with('error', 'Product Deleted successfully ✅');
    }

    public function index()
    {
        //
    }


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
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }
}
