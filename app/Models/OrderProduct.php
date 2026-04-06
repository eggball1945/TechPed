<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product'; // nama tabel sesuai database (singular)

    protected $fillable = [
        'order_id',
        'product_id',
        'jumlah',   // bukan 'quantity'
        'harga',    // bukan 'price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}