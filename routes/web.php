<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\web\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('user/')->group(function () {
    Route::get('login', [UserController::class, 'showLoginForm'])->name('user.login');
    Route::post('login', [UserController::class, 'login'])->name('user.post');
    Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('register', [UserController::class, 'user_register'])->name('user.register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
});

// Admin authentication routes
Route::prefix('admin/')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminController::class, 'login'])->name('post');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');
});
// Product Listing
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Order Placement
Route::post('/order', [OrderController::class, 'store'])->name('order.store');


Route::prefix('/admin/')->middleware(['auth:admin'])->group(function () {
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/orders', [DashboardController::class, 'orders'])->name('admin.orders');
Route::get('/products', [DashboardController::class, 'products'])->name('admin.products');
});
Route::middleware('auth:web')->group(function () {

     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__ . '/auth.php';
