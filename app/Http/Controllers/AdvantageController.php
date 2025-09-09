<?php

namespace App\Http\Controllers;

use App\Models\advantage;
use App\Models\service;
use Illuminate\Http\Request;

class AdvantageController extends Controller
{
    public function redirect_advanatage()
    {
        $advantages = advantage::all();
        $services = service::all();
        return view('admin/admin_service', compact('advantages', 'services'));
    }

    public function add_advantage()
    {
        return view('admin/add_advantage');
    }
    public function advantage_added(Request $request)
    {
        $advanatage = new advantage();
        $advanatage->advantage_title = $request->advantage_title;
        $advanatage->advantage_description = $request->description;
        $advanatage->advantage_icon = $request->icon;
        $advanatage->save();
        return redirect()->route('admin_service')->with('success', 'Advantage Added successfully ✅');
    }
    public function edit_advantage($id)
    {
        $advantage = advantage::find($id);
        return view('admin/edit_advantage', compact('advantage'));
    }
    public function advantage_updated(Request $request, $id)
    {
        $advanatge = advantage::find($id);
        $advanatge->advantage_title = $request->advantage_title;
        $advanatge->advantage_description = $request->description;
        $advanatge->advantage_icon = $request->icon;
        $advanatge->save();
        return redirect()->route('admin_service')->with('success', 'Advantage Updated successfully ✅');
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
    public function show(advantage $advantage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(advantage $advantage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, advantage $advantage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(advantage $advantage)
    {
        //
    }
}
