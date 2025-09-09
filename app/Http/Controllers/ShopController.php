<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Products;

class ShopController extends Controller
{
    public function shop()
    {

        $products = products::all();
        $brands = Brand::orderBy('name')->get();

        $rams = Products::select('ram')->distinct()->orderBy('ram')->pluck('ram');

        $priceRanges = [
            '5000-10000' => '₹5,000 - ₹10,000',
            '10000-20000' => '₹10,000 - ₹20,000',
            '20000-40000' => '₹20,000 - ₹40,000',
            '40000+' => 'Above ₹40,000',
        ];

        return view('shop', compact('brands', 'products', 'priceRanges', 'rams'));
    }
}
