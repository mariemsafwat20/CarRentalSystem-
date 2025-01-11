<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\OrderController;

Route::get('/cars', [CarController::class, 'index']);

Route::get('/orders', action: [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::patch('/orders/{order}/pay', [OrderController::class, 'update']);
Route::patch('/orders/{order_id}/pay', [OrderController::class, 'markAsPaid']);
