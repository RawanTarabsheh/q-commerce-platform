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
                    <th>User Name</th>
                    <th>quantity</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)

                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                         <td>{{ $order->product->name }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $orders->links() }}

        </div>
    </div>

    </div>
@endsection
