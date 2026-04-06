<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'username',
        'tanggal',
        'jumlah_barang',
        'total_harga',
        'shipping',
        'shipping_cost',
        'payment',
        'status',
        'proof_image',
        'no_telepon',
        'email',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'subtotal',
        'diskon',
        'pajak',
        'biaya_tambahan',
        'resi',
        'estimasi_hari'
    ];

    protected $casts = [
        'total_harga'   => 'float',
        'subtotal'      => 'float',
        'diskon'        => 'float',
        'pajak'         => 'float',
        'shipping_cost' => 'float',
        'biaya_tambahan' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')
                    ->withPivot('jumlah', 'harga');
    }

    // Helper to get full URL of proof image
    public function getProofImageUrlAttribute()
    {
        return $this->proof_image ? asset('storage/' . $this->proof_image) : null;
    }
}