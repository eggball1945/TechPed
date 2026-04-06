<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['name', 'end_date'];

    protected $casts = [
        'end_date' => 'datetime',
    ];
}