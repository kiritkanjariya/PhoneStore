<?php

namespace App\Http\Controllers;

use App\Models\drawback;
use App\Models\about;
use App\Models\Contacts;
use Illuminate\Http\Request;

class DrawbackController extends Controller
{
     public function redirect_contact_about()
    {
        $contactInfo  = Contacts::all();
        $abouts  = about::all();
        $drawbacks = drawback::all();
        return view('admin/admin_contact_about', compact('abouts','contactInfo', 'drawbacks'));
    }
     public function add_drawback()
    {
        return view('admin/add_drawback');
    }
    public function drawback_added(Request $request)
    {
        $drawback = new drawback();

        $drawback->drawback = $request->drawback_name;
        $drawback->description = $request->description;
        $drawback->save();
        return redirect()->route('admin_contact_about')->with('success', 'Drawback Added successfully ✅');
    }
    public function edit_drawback($id)
    {
        $drawback = drawback::find($id);
        return view('admin/edit_drawback', compact('drawback'));
    }
    public function drawback_updated(Request $request , $id)
    {
        $drawback = drawback::find($id);
        $drawback->drawback = $request->drawback_name;
        $drawback->description = $request->description;
        $drawback->save();
        return redirect()->route('admin_contact_about')->with('success', 'Drawback Updated successfully ✅');
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
    public function show(drawback $drawback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(drawback $drawback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, drawback $drawback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(drawback $drawback)
    {
        //
    }
}
