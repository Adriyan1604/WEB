<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

// === Halaman Customer Order ===
Route::get('/customerorder', function (Request $request) {
    $menu = $request->query('menu');
    $price = $request->query('price');
    $image = $request->query('image');
    return view('customerorder', compact('menu', 'price', 'image'));
})->name('order.customer');

Route::get('/qris', function () {
    return view('qris');
})->name('qris');

// === Auth Routes ===
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// === Dashboard Routes ===
Route::get('/home', function () {
    return view('home');
})->name('user.dashboard');

Route::get('/admin', function () {
    return view('admin');
})->name('admin.dashboard');

// === Public Pages ===
Route::get('/', function () {
    return view('home');
});

Route::get('/menu', function () {
    return view('menu');
});

Route::get('/order', function () {
    return view('order'); // Ini halaman order umum, bukan customerorder
});
