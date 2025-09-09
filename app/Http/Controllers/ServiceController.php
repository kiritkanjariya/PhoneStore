<?php

namespace App\Http\Controllers;

use App\Models\service;
use App\Models\advantage;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function service()
    {
        $services = service::all();
        $advantages = advantage::all();
        return view('service', compact('services', 'advantages'));
    }

    public function redirect_service()
    {
        $services = service::all();
        $advantages = advantage::all();
        return view('admin/admin_service', compact('services','advantages'));
    }

    public function add_service()
    {
        return view('admin/add_service');
    }
    public function service_added(Request $request)
    {
        $service = new service();
        $service->service_title = $request->service_name;
        $service->service_description = $request->description;
        $service->service_icon = $request->icon;
        $service->save();
        return redirect()->route('admin_service')->with('success', 'Service Added successfully ✅');
    }
    public function edit_service($id)
    {
        $service = service::find($id);
        return view('admin/edit_service', compact('service'));
    }
    public function service_updated(Request $request, $id)
    {
        $service = service::find($id);
        $service->service_title = $request->service_name;
        $service->service_description = $request->description;
        $service->service_icon = $request->icon;
        $service->save();
        return redirect()->route('admin_service')->with('success', 'Service Updated successfully ✅');
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
    public function show(service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service $service)
    {
        //
    }
}
