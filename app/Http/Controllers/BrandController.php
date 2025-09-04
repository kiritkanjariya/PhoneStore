<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function add_brand()
    {
        return view('admin/add_brand');
    }
    public function brand_added(Request $form)
    {
        $brand = new Brand();
        $brand->name = $form->brand_name;
        $brand->status = $form->status;
        $brand->save();
        return redirect()->route('admin_brand')->with('success', 'Brand Added successfully ✅');
    }
     public function redirect_brand()
    {
        $brands = Brand::all();
        return view('admin/admin_brand',compact('brands'));
    }

    public function edit_brand($id)
    {
        $brands = Brand::findOrFail($id);
        
        return view('admin/edit_brand',compact('brands'));
    }

    public function brand_updated(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->name = $request->brand_name;
        $brand->status = $request->status;

        $brand->save();
        return redirect()->route('admin_brand')->with('success', 'Brand Updated successfully ✅');
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
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
