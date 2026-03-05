<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        // Mengambil semua data produk dari database agar variabel $products terdefinisi
        $products = Product::all(); 
        
        // Mengirim data ke view welcome.blade.php
        return view('welcome', compact('products'));
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $transaction = Transaction::create([
                'invoice' => 'YFO-' . strtoupper(uniqid()),
                'total_amount' => $request->total,
                'cashier_name' => 'Yafao Elite Admin'
            ]);

            foreach ($request->cart as $item) {
                $product = Product::lockForUpdate()->find($item['id']);
                
                if ($product->stock < $item['qty']) {
                    return response()->json(['message' => 'Stok Habis, Bosku!'], 400);
                }

                $product->decrement('stock', $item['qty']);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'price_at_sale' => $product->price
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Verified by YAFAO System',
                'invoice' => $transaction->invoice
            ]);
        });
    }
}