<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'nama_produk',
        'sku',
        'deskripsi',
        'kategori',
        'harga',
        'stok',
        'gambar'
    ];

    protected $casts = [
        'gambar' => 'array',
    ];

    protected $appends = ['gambar_array'];

    public function getGambarArrayAttribute()
    {
        if (is_array($this->gambar)) {
            return $this->gambar;
        }

        if (is_string($this->gambar)) {
            // coba decode JSON dulu
            $decoded = json_decode($this->gambar, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }

            // fallback: comma separated
            return explode(',', $this->gambar);
        }

        return [];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}