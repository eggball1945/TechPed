<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
    ];
}
