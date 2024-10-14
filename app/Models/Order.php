<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'medicines', 'name_customer', 'total_price'];
    // karena migration tidak bisa membaca tipe data array, jd array di migration(json), agar nantinya benrik medicines berupa array (store/get) jd harus dipastikan dengan cast

    protected $casts = [
        'medicines' => 'array'
    ];
}