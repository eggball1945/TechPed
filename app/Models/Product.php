<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $appends = ['gambar_array'];

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

    public function getGambarArrayAttribute()
    {
        if (!$this->gambar) return [];
        
        $decoded = json_decode($this->gambar, true);
        
        // Jika berhasil di-decode sebagai JSON array
        if (is_array($decoded)) {
            return $decoded;
        }
        
        // Fallback jika format lama pakai koma
        return explode(',', $this->gambar);
    }
}