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


    // login User


    public function showCheckOut()
    {
        return view('checkout');
    }

    public function review_rating()
    {
        return view('review&rating');
    }

    public function order()
    {
        return view('orders');
    }

    // admin controller 

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

    public function redicrect_order()
    {
        return view('admin/admin_order');
    }
    public function edit_order()
    {
        return view('admin/edit_order');
    }
    public function order_updated()
    {
        return view('admin/admin_order');
    }
    public function add_offer()
    {
        return view('admin/add_offer');
    }
    public function offer_added()
    {
        return view('admin/admin_offers');
    }
    public function edit_offer()
    {
        return view('admin/edit_offers');
    }
    public function offer_updated()
    {
        return view('admin/admin_offers');
    }
}
