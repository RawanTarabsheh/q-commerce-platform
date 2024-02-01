@extends('admin.layouts.app')

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

    <!-- Content Area -->
    <div class="content">

        <!-- Site Statistics Section -->
        <div class="stats-section">
            <h2>Site Statistics</h2>
            <div class="stats-box"><label>Total Users:</label>
                <span class="stat-number">{{ isset($userCount) ? $userCount : 0 }}</span>
            </div>
            <div class="stats-box"><label>Total Order:</label>
                <span class="stat-number">{{ isset($orderCount) ? $orderCount : 0 }}</span>
            </div>
            <div class="stats-box"><label>Total Product:</label>
                <span class="stat-number">{{ isset($productCount) ? $productCount : 0 }}</span>
            </div>

            <!-- Add more statistics boxes as needed -->
        </div>



    </div>

</div>

@endsection
