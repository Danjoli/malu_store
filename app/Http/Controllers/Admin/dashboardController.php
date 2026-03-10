<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalClients = User::count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalClients'
        ));
    }
}
