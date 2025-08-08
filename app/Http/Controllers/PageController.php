<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        return view('index');
    }

    public function showLoginForm(){
        return view('login');
    }

    public function showRegisterForm(){
        return view('registration');
    }
    
    public function about(){
        return view('about_us');
    }

    public function contact(){
        return view('contact_us');
    }
    
    public function service(){
        return view('service');
    }

    public function shop(){
        return view('shop');
    }

    public function phone_details(){
        return view('phone_detail');
    }

    public function forgot_password(){
        return view('forgot_pass');
    }

    public function cart(){
        return view('add_to_cart');
    }


    // login User

    public function showProfile() {
        return view('profile');
    }
    public function showCheckOut() {
        return view('checkout');
    }   

    public function showReview() {
        return view('review');
    }

    public function order(){
        return view('order');
    }

    // admin controller 

    public function redicrect_dashboard()
    {
        return view('admin/admin_dashboard');
    }
    public function redicrect_users()
    {
        return view('admin/admin_users');
    }
    public function user_updated()
    {
        return view('admin/admin_users');
    }
    public function edit_users()
    {
        return view('admin/edit_user');
    }
    public function user_add()
    {
        return view('admin/add_user');
    }
    public function redicrect_slider()
    {
        return view('admin/admin_slider');
    }
    public function user_added()
    {
        return view('admin/admin_users');
    }

    public function add_slider()
    {
        return view('admin/add_slider');
    }
    public function slider_updated()
    {
        return view('admin/admin_slider');
    }
    public function edit_slider()
    {
        return view('admin/edit_slider');
    }

    public function slider_added()
    {
        return view('admin/admin_slider');
    }

    public function edit_product()
    {
        return view('admin/edit_product');
    }
    public function product_updated()
    {
        return view('admin/admin_product');
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
    public function add_discount()
    {
        return view('admin/add_discount');
    }
    public function discount_added()
    {
        return view('admin/admin_offers');
    }
    public function redirect_brand()
    {
        return view('admin/admin_brand');
    }
  
    public function edit_brand()
    {
        return view('admin/edit_brand');
    }
    public function brand_updated()
    {
        return view('admin/admin_brand');
    }
    public function redirect_contact_about()
    {
        return view('admin/admin_contact_about');
    }
    public function redirect_service()
    {
        return view('admin/admin_service');
    }
    public function contact_updated()
    {
        return view('admin/admin_contact_about');
    }
    public function about_updated()
    {
        return view('admin/admin_contact_about');
    }
    public function add_drawback()
    {
        return view('admin/add_drawback');
    }
    public function drawback_added()
    {
        return view('admin/admin_contact_about');
    }
    public function edit_drawback()
    {
        return view('admin/edit_drawback');
    }
    public function drawback_updated()
    {
        return view('admin/admin_contact_about');
    }
    public function add_service()
    {
        return view('admin/add_service');
    }
    public function service_added()
    {
        return view('admin/admin_service');
    }
    public function edit_service()
    {
        return view('admin/edit_service');
    }
    public function service_updated()
    {
        return view('admin/admin_service');
    }

}
