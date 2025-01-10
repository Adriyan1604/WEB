<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// User Dashboard
Route::get('/home', function () {
    return view('home');
})->name('user.dashboard');

// Admin Dashboard
Route::get('/admin', function () {
    return view('admin'); // Mengarahkan ke resources/views/admin.blade.php
})->name('admin.dashboard');




// Rute untuk halaman Home
Route::get('/', function () {
    return view('home'); // Halaman Home
});

// Rute untuk halaman Menu
Route::get('/menu', function () {
    return view('menu'); // Halaman Menu
});


Route::get('/order', function () {
    return view('order'); // Halaman Menu
});

Route::get('/login', function () {
    return view('login'); // Halaman Menu
});

