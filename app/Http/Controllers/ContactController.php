<?php

namespace App\Http\Controllers;
use App\Models\Contacts;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{

    public function contact()
    {
        $cantactInfo = Contacts::first();
        return view('contact_us', compact('cantactInfo'));
    }

    public function contact_updated(Request $request)
    {
        $contact = new Contacts();
        $contact->location = $request->address;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();
        return view('admin/admin_contact_about');
    }

}
