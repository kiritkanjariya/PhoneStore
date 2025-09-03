<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function showRegisterForm()
    {
        return view('registration');
    }

    public function about()
    {
        return view('about_us');
    }


    public function service()
    {
        return view('service');
    }

    public function shop()
    {
        return view('shop');
    }

    public function phone_details()
    {
        return view('phone_detail');
    }

    public function forgot_password()
    {
        return view('forgot_pass');
    }

    public function cart()
    {
        return view('add_to_cart');
    }


    // login User

    
    public function showCheckOut()
    {
        return view('checkout');
    }

    public function showReview()
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
        return view('admin/admin_dashboard');
    }

    public function admin_changed_profile()
    {
        return view('admin/admin_profile');
    }
    public function admin_changed_password()
    {
        return view('admin/admin_profile');
    }
    public function admin_profile()
    {
        return view('admin/admin_profile');
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
    public function edit_discount()
    {
        return view('admin/edit_discount');
    }
    public function discount_updated()
    {
        return view('admin/admin_offers');
    } 

}
