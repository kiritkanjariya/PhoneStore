<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Contact_query;

use Illuminate\Http\Request;

class Contact_query_Controller extends Controller
{
    public function submitQuery(Request $request)
    {
        $query = new Contact_query();
        $query->name = $request->full_name;
        $query->email = $request->email;
        $query->phone = $request->phone;
        $query->message = $request->message;
        $query->save();

        return back()->with('success', 'Thank you! Your query has been submitted.');
    }

}
