<?php

namespace App\Http\Controllers;
use App\Models\Contacts;
use App\Models\about;
use App\Models\drawback;

use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function contact()
    {
        $contactInfo = Contacts::first();
        return view('contact_us', compact('contactInfo'));
    }

    public function redirect_contact_about()
    {
        $abouts  = about::all();
        $contactInfo  = Contacts::all();
        $drawbacks = drawback::all();

        return view('admin/admin_contact_about', compact('contactInfo','abouts','drawbacks'));
    }

    public function contact_updated(Request $request)
    {
        $contact = Contacts::first();
        $contact->location = $request->address;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->save();
        return $this->redirect_contact_about();
    }

}
