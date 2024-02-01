<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Retrieve the authenticated user
    $user = auth()->user();

    // Create a new order associated with the user
    $order = $user->orders()->create([
        'product_id' => $request->input('product_id'),
        'quantity' => $request->input('quantity'),
        'status'=>'pending'
    ]);

    // Additional logic such as updating inventory, sending confirmation emails, etc.

    return redirect()->route('products.index')->with('success', $request->input('product_name').' (# '.$request->input('quantity').' ) placed successfully!');
}
}
