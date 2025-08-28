<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function redicrect_slider()
    {
        $sliders = Slider::all();
        return view('admin/admin_slider', compact('sliders'));
    }

    public function add_slider()
    {
        return view('admin/add_slider');
    }

    public function slider_added(Request $request)
    {
        $slider = new Slider();
        $slider->status = $request->status;

        if ($request->hasFile('slider_image')) {
            $file = $request->file('slider_image');
            $originalName = $file->getClientOriginalName();
            $file->move(public_path('img/sliders'), $originalName);
            $slider->image = $originalName;
        }

        $slider->save();
        return $this->redicrect_slider();
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);


        if ($slider->image && file_exists(public_path('img/sliders/' . $slider->image))) {
            unlink(public_path('img/sliders/' . $slider->image));
        }

        $slider->delete();

        return redirect()->back()->with('success', 'Slider deleted successfully!');
    }
    /**
     * Display a listing of the resource.
     */
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
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

}
