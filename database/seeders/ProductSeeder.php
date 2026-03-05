<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama dulu biar nggak numpuk
        Product::truncate();

        $products = [
            ['name' => 'Yafao Elite Smartphone V1', 'sku' => 'YFO-PHN-01', 'price' => 15000000, 'stock' => 12],
            ['name' => 'Yafao Luxury MacBook Pro', 'sku' => 'YFO-LAP-02', 'price' => 28500000, 'stock' => 5],
            ['name' => 'Yafao Titanium Watch Elite', 'sku' => 'YFO-WTC-03', 'price' => 9200000, 'stock' => 15],
            ['name' => 'Yafao Cyber Headphones G7', 'sku' => 'YFO-AUD-04', 'price' => 4500000, 'stock' => 20],
            ['name' => 'Yafao Mirrorless Camera 8K', 'sku' => 'YFO-CAM-05', 'price' => 21000000, 'stock' => 4],
            ['name' => 'Yafao Smart Vision Glasses', 'sku' => 'YFO-GLS-06', 'price' => 7800000, 'stock' => 10],
            ['name' => 'Yafao Gaming Console X', 'sku' => 'YFO-CNS-07', 'price' => 8999000, 'stock' => 8],
            ['name' => 'Yafao Portable Power Station', 'sku' => 'YFO-PWR-08', 'price' => 3200000, 'stock' => 25],
            ['name' => 'Yafao Ultra Slim Tablet', 'sku' => 'YFO-TAB-09', 'price' => 12500000, 'stock' => 14],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}