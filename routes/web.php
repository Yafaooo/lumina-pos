<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;

// Pastikan ini memanggil fungsi index di Controller, bukan langsung view
Route::get('/', [PosController::class, 'index']);

// Route untuk proses transaksi (Checkout)
Route::post('/checkout', [PosController::class, 'store'])->name('checkout');