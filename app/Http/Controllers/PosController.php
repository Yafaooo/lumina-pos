<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        // KITA PAKSA DATA TANPA DATABASE SUPAYA ONLINE NYALA 100%
        $products = [
            (object)[
                'id' => 1, 
                'name' => 'Yafao Elite Smartphone V1', 
                'sku' => 'YFO-PHN-01', 
                'price' => 15000000, 
                'stock' => 12
            ],
            (object)[
                'id' => 2, 
                'name' => 'Yafao Luxury MacBook Pro', 
                'sku' => 'YFO-LAP-02', 
                'price' => 28500000, 
                'stock' => 5
            ],
            (object)[
                'id' => 3, 
                'name' => 'Yafao Titanium Watch Elite', 
                'sku' => 'YFO-WTC-03', 
                'price' => 9200000, 
                'stock' => 15
            ],
            (object)[
                'id' => 4, 
                'name' => 'Yafao Cyber Headphones G7', 
                'sku' => 'YFO-AUD-04', 
                'price' => 4500000, 
                'stock' => 20
            ],
            (object)[
                'id' => 5, 
                'name' => 'Yafao Mirrorless Camera 8K', 
                'sku' => 'YFO-CAM-05', 
                'price' => 21000000, 
                'stock' => 4
            ],
            (object)[
                'id' => 6, 
                'name' => 'Yafao Smart Vision Glasses', 
                'sku' => 'YFO-GLS-06', 
                'price' => 7800000, 
                'stock' => 10
            ],
        ];

        return view('welcome', compact('products'));
    }

    public function store(Request $request)
    {
        // Simulasi transaksi sukses tanpa database
        return response()->json([
            'status' => 'success',
            'message' => 'Verified by YAFAO System (Demo Mode)',
            'invoice' => 'YFO-' . strtoupper(uniqid())
        ]);
    }
}