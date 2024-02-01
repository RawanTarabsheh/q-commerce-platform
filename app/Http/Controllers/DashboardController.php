<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $orders = Order::all();
        $orderCount = Order::count();
        $userCount = User::count();
        $productCount = Product::count();
        return view('admin.dashboard', compact('orderCount','userCount','productCount'));
    }
    public function orders()
    {
        $orders = Order::with(['product','user'])->paginate(10);

        return view('admin.orders', compact('orders'));
    }
    public function products()
    {
        $products = Product::paginate(10);

        return view('admin.products', compact('products'));
    }

}
