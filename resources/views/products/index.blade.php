@extends('layouts.app')
@section('nav_bar')
<div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login') && Auth::guard('web'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">

                   <a href="{{ route('products.index') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Products</a>



                        <form method="POST" action="{{ route('user.logout') }}">
                            @csrf

                            <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                        </a>
                        </form>
                @else
                    <a href="{{ route('user.login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('user.register'))
                        <a href="{{ route('user.register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif

            </div>
        @endif
</div>
@endsection
@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Products</h1>
    <div class="col-6 mt-3">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <ul class="list-group">
        @foreach($products as $product)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="product-info">
                    <img src="{{ asset('images/product.jpg') }}" alt="{{ $product->name }}" class="product-image">
                    <div class="product-details">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <span class="badge bg-primary">{{ $product->price }} $</span>
                    </div>
                </div>
                <form action="{{ route('order.store') }}" method="post" class="order-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control" style="width: 70px;">

                    <button type="submit" class="btn btn-success order_btn">Place Order</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
