<?php

namespace App\Http\Controllers;

use App\Models\about;
use App\Models\Contacts;
use App\Models\drawback;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function redirect_contact_about()
    {
        $contactInfo  = Contacts::all();
        $abouts  = about::all();
        $drawbacks = drawback::all();
        return view('admin/admin_contact_about', compact('abouts','contactInfo', 'drawbacks'));
    }
    public function about_updated(Request $request)
    {

        $about = About::first();

        $about->about_description = $request->about_text;
        $about->mission = $request->mission;

        if ($request->about_image) {

            if ($about->image && file_exists(public_path('img/sliders/' . $about->image))) {
                unlink(public_path('img/sliders/' . $about->image));
            }

            $file = $request->file('about_image');
            $file->move(public_path('img/sliders/'), $file->getClientOriginalName());

            $about->image = $file->getClientOriginalName();
        }

        $about->save();

        return redirect()->route('admin_contact_about')->with('success', 'About Updated successfully ✅');
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
    public function show(about $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(about $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, about $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(about $about)
    {
        //
    }
}
