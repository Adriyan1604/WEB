<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

// Grouping routes with 'api' prefix
Route::prefix('api')->group(function () {

    // Routes for Orders
    Route::get('orders', [OrderController::class, 'index']);  // Get all orders
    Route::post('orders', [OrderController::class, 'store']);  // Create a new order
    Route::put('orders/{id}', [OrderController::class, 'update']);  // Update an order by ID
    Route::delete('orders/{id}', [OrderController::class, 'destroy']);  // Delete an order by ID

    // Routes for Menus
    Route::get('menus', [MenuController::class, 'index']);  // Get all menus
    Route::post('menus', [MenuController::class, 'store']);  // Create a new menu item
    Route::put('menus/{id}', [MenuController::class, 'update']);  // Update a menu item by ID
    Route::delete('menus/{id}', [MenuController::class, 'destroy']);  // Delete a menu item by ID
});
