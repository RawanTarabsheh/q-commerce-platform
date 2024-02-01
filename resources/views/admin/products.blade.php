@extends('admin.layouts.app')
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Companies') }}
    </h2>
@endsection

@section('content')
    <div class="container">

         <!-- Sidebar -->
    <div class="sidebar">
        <!-- Add navigation links or other sidebar content here -->
        <p>Sidebar</p>
        <a href="{{ route('dashboard') }}">Home</a>
        <a href="{{ route('admin.orders') }}">Orders</a>
        <a href="{{ route('admin.products') }}">Products</a>

    </div>


        <div>

        <table class="table mt-5 ml-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product price</th>
                    <th>description</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)

                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                         <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $products->links() }}

        </div>
    </div>

    </div>
@endsection
