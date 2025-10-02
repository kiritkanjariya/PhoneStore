<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Products;
use App\Models\orders;
use App\Models\Brand;
use App\Models\Review;
use Carbon\Carbon;





class DashboardController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => User::count(),
            'active' => User::active()->count(),
            'inactive' => User::inactive()->count(),
            'new' => User::newUsers()->count(),
        ];

        $usersList = [
            'all' => User::all(),
            'active' => User::active()->get(),
            'inactive' => User::inactive()->get(),
            'new' => User::newUsers()->get(),
        ];

        $productsList = [
            'totalProducts' => Products::count(),
            'inStock' => Products::where('stock_quantity', '>', 0)->count(),
            'totalSales' => orders::sum('total_amount'),
            'todayRevenue' => Orders::whereDate('created_at', Carbon::today())->sum('total_amount'),
        ];

        $orderslist = [
            'totalOrders' => Orders::count(),
            'pendingOrders' => Orders::where('order_status', 'pending')->count(),
            'deliveredOrders' => Orders::where('order_status', 'delivered')->count(),
            'brandsCount' => Brand::count(),
        ];

        $reviewstats = [
            'totalReviews' => Review::whereNotNull('review')->count(), // only reviews with text
            'totalRatings' => Review::whereNotNull('rating')->count(), // ratings count
        ];

        return view('admin.admin_dashboard', compact('stats', 'usersList', 'productsList', 'orderslist','reviewstats'));
    }

}
