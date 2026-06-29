<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $total_product = Product::count();
        $total_order = Order::count();
        $total_user = User::count();
        $total_revenue = Order::sum('price');
        $total_delivered = Order::delivered()->count();
        $total_processing = Order::pending()->count();

        return view('admin.home', compact(
            'total_product',
            'total_order',
            'total_user',
            'total_revenue',
            'total_delivered',
            'total_processing'
        ));
    }
}
