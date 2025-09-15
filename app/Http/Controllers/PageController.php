<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function showRegisterForm()
    {
        return view('registration');
    }

    public function phone_details()
    {
        return view('phone_detail');
    }

    public function forgot_password()
    {
        return view('forgot_pass');
    }

    public function redicrect_dashboard()
    {
        if (!Session::has('admin')) {
            return redirect()->route('login');
        }
        return view('admin/admin_dashboard');
    }

    public function redicrect_review_rating()
    {
        return view('admin/admin_review_rating');
    }
    public function redicrect_offers()
    {
        return view('admin/admin_offers');
    }
}
