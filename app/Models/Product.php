<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Ini kuncinya! Kita izinkan semua field diisi (Mass Assignment)
    protected $guarded = []; 
}