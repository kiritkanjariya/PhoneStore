<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Brand;
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
        $products->screen_size = $formdata->screen_size;
        $products->Feature_highlight = $formdata->feature_highlight;
        $products->stock_quantity = $formdata->stock;
        $products->brand_id = $formdata->brand;
        if ($formdata->hasFile('product_image')) {
            $file = $formdata->file('product_image');
            $originalName = $file->getClientOriginalName();
            $file->move(public_path('img\product-images'), $originalName);
            $products->image = $originalName;
        }
        $products->save();
        return $this->redicrect_product();
    }


    public function home()
    {

        $today = Carbon::today();

        DB::table('discounts')
            ->where('end_date', '<', $today)
            ->where('status', '!=', 'inactive')
            ->update([
                'status' => 'inactive',
                'deal_tag' => 'Sale Ended'
            ]);

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

        $sliders = Slider::where('status', 'active')->get();    
        return view('index', compact('products','sliders'));
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
