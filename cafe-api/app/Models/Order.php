<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'customer_name',  // Nama pelanggan
        'product_name',   // Nama produk
        'quantity',       // Jumlah barang yang dipesan
        'price',          // Harga per produk
    ];
}
