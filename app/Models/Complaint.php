<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'petugas_id',
        'type',
        'description',
        'evidence_video',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function getEvidenceVideoUrlAttribute()
    {
        return $this->evidence_video ? asset('storage/' . $this->evidence_video) : null;
    }
}
