<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdvantageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Contact_query_Controller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DrawbackController;
use App\Http\Controllers\ServiceController;

Route::get('/login_form', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginProcess');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/registration', [PageController::class, 'showRegisterForm'])->name('register');
Route::get('/activation/{token}', [UserController::class, 'activation'])->name('activation');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/service', [ServiceController::class, 'service'])->name('service');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/cart', [PageController::class, 'cart'])->name('cart_detail')->middleware('check.user');
Route::get('/details/{id}', [ProductsController::class, 'phone_details'])->name('phone_details');
Route::get('/forgot_password', [PageController::class, 'forgot_password'])->name('forgot_pass');
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile')->middleware('check.user');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update')->middleware('check.user');
Route::post('/changed_password/{id}', [ProfileController::class, 'changed_password'])->name('changed_password')->middleware('check.user');
Route::post('/forgot_password_submit', [AuthController::class, 'forgot_password_submit'])->name('forgot_password_submit');
Route::get('/otp', [AuthController::class, 'otp'])->name('otp');
Route::get('/new_password/{email}', [AuthController::class, 'new_password'])->name('new_password');
Route::post('/otp_submit', [AuthController::class, 'otp_submit'])->name('otp_submit');
Route::post('/reset_password/{email}', [AuthController::class, 'reset_password'])->name('reset_password');

Route::get('/orders', [CheckoutController::class, 'order'])->name('order')->middleware('check.user');
Route::get('/Checkout', [CheckoutController::class, 'showCheckout'])->name('Checkout')->middleware('check.user');
Route::post('/CheckoutProcess', [CheckoutController::class, 'processOrder'])->name('Checkoutprocess')->middleware('check.user');
Route::get('/review-rating/{id}', [CheckoutController::class, 'review_rating'])->name('review_rating')->middleware('check.user');
Route::post('/review-rating_submit/{id}', [CheckoutController::class, 'review_rating_submit'])->name('review_rating_submit')->middleware('check.user');
Route::delete('/review/{id}', [CheckoutController::class, 'delete_review'])->name('delete_review');

Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/', [ProductsController::class, 'home'])->name('home');
Route::get('/admin_logout', [AuthController::class, 'admin_logout'])->name('admin_logout');
Route::get('/add_product', [ProductsController::class, 'add_product'])->name('add_product');
Route::post('/added_product', [ProductsController::class, 'product_added'])->name('product_added');
Route::get('/admin_product', [ProductsController::class, 'redicrect_product'])->name('admin_product');
Route::delete('/product/{id}', [ProductsController::class, 'destroy'])->name('product.destroy');
Route::post('/register_submit', [UserController::class, 'register_submit'])->name('register_submit');
Route::get('/add_brand', [BrandController::class, 'add_brand'])->name('add_brand');
Route::post('/brand_added', [BrandController::class, 'brand_added'])->name('brand_added');
Route::get('/add_discount', [DiscountController::class, 'add_discount'])->name('add_discount');
Route::post('/added_discount', [DiscountController::class, 'discount_added'])->name('discount_added');
Route::get('/admin_offers', [DiscountController::class, 'redicrect_offers'])->name('admin_offers');
Route::delete('/discount/{id}', [DiscountController::class, 'destroy'])->name('discount.destroy');
Route::get('/slider', [SliderController::class, 'redicrect_slider'])->name('admin_slider');
Route::get('/add_slider', [SliderController::class, 'add_slider'])->name('add_slider');
Route::post('/added_slider', [SliderController::class, 'slider_added'])->name('slider_added');
Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact_updated', [ContactController::class, 'contact_updated'])->name('contact_updated');
Route::post('/contact/submit', [Contact_query_Controller::class, 'submitQuery'])->name('contact.submit');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin_dashboard');
Route::get('/users', [UserController::class, 'redicrect_users'])->name('admin_users');
Route::get('/edit_users/{id}', [UserController::class, 'edit_users'])->name('edit_user');
Route::post('/users_updated/{id}', [UserController::class, 'user_updated'])->name('user_updated');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/add_user', [UserController::class, 'user_add'])->name('add_user');
Route::post('/added_user', [UserController::class, 'user_added'])->name('user_added');
Route::get('/edit_slider/{id}', [SliderController::class, 'edit_slider'])->name('edit_slider');
Route::post('/updated_slider/{id}', [SliderController::class, 'slider_updated'])->name('slider_updated');
Route::get('/edit_product/{id}', [ProductsController::class, 'edit_product'])->name('edit_product');
Route::post('/updated_product/{id}', [ProductsController::class, 'product_updated'])->name('product_updated');
Route::get('/admin_profile', [ProfileController::class, 'admin_profile'])->name('admin_profile');
Route::post('/admin_changed_profile/{id}', [ProfileController::class, 'admin_changed_profile'])->name('admin_changed_profile');
Route::post('/admin_changed_password/{id}', [ProfileController::class, 'admin_changed_password'])->name('admin_changed_password');
Route::get('/admin_review_rating', [CheckoutController::class, 'redicrect_review_rating'])->name('admin_review_rating');
Route::get('/admin_order', [CheckoutController::class, 'redicrect_order'])->name('admin_order');
Route::get('/edit_order/{id}', [CheckoutController::class, 'edit_order'])->name('edit_order');
Route::post('/updated_order/{id}', [CheckoutController::class, 'order_updated'])->name('order_updated');
Route::get('/add_offer', [DiscountController::class, 'add_offer'])->name('add_offer');
Route::post('/added_offer', [DiscountController::class, 'offer_added'])->name('offer_added');
Route::get('/edit_offer{id}', [DiscountController::class, 'edit_offer'])->name('edit_offer');
Route::post('/updated_offer{id}', [DiscountController::class, 'offer_updated'])->name('offer_updated');
Route::get('/edit_discount{id}', [DiscountController::class, 'edit_discount'])->name('edit_discount');
Route::post('/updated_discount{id}', [DiscountController::class, 'discount_updated'])->name('discount_updated');
Route::post('/delete_offer{id}', [DiscountController::class, 'destory'])->name('offer.destroy');
Route::get('/admin_brand', [BrandController::class, 'redirect_brand'])->name('admin_brand');
Route::get('/edit_brand/{id}', [BrandController::class, 'edit_brand'])->name('edit_brand');
Route::post('/brand_updated/{id}', [BrandController::class, 'brand_updated'])->name('brand_updated');
Route::get('/admin_service', [ServiceController::class, 'redirect_service'])->name('admin_service');
Route::get('/admin_contact_about', [AboutController::class, 'redirect_contact_about'])->name('admin_contact_about');
Route::post('/about_updated', [AboutController::class, 'about_updated'])->name('about_updated');
Route::get('/add_drawback', [DrawbackController::class, 'add_drawback'])->name('add_drawback');
Route::post('/drawback_added', [DrawbackController::class, 'drawback_added'])->name('drawback_added');
Route::get('/edit_drawback/{id}', [DrawbackController::class, 'edit_drawback'])->name('edit_drawback');
Route::post('/drawback_updated/{id}', [DrawbackController::class, 'drawback_updated'])->name('drawback_updated');
Route::get('/add_service', [ServiceController::class, 'add_service'])->name('add_service');
Route::post('/service_added', [ServiceController::class, 'service_added'])->name('service_added');
Route::get('/edit_service/{id}', [ServiceController::class, 'edit_service'])->name('edit_service');
Route::post('/service_updated/{id}', [ServiceController::class, 'service_updated'])->name('service_updated');

Route::get('/add_advantage', [AdvantageController::class, 'add_advantage'])->name('add_advantage');
Route::post('/advantage_added', [AdvantageController::class, 'advantage_added'])->name('advantage_added');
Route::get('/edit_advantage/{id}', [AdvantageController::class, 'edit_advantage'])->name('edit_advantage');
Route::post('/advantage_updated/{id}', [AdvantageController::class, 'advantage_updated'])->name('advanatage_updated');

Route::get('/cart', [CartController::class, 'cart'])->name('cart_detail')->middleware('check.user');
Route::get('/add_to_cart/{id}', [CartController::class, 'add_cart'])->name('add_cart')->middleware('check.user');
Route::post('/cart/increase/{id}', [CartController::class, 'increaseQuantity'])->name('increase_quantity')->middleware('check.user');
Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('decrease_quantity')->middleware('check.user');
Route::post('/cart/{id}', [CartController::class, 'delete_cart_item'])->name('delete_cart_item')->middleware('check.user');

Route::post('/coupon', [DiscountController::class, 'apply_coupon'])->name('coupon_apply')->middleware('check.user');


Route::post('/search', [ShopController::class, 'search'])->name('product_search');
