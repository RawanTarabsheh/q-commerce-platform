<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        // Get all products
        $products = Product::all();
        return view('products.index', compact('products'));
    }

}
