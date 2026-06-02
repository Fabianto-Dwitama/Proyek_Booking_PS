<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playstation extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'nomor_ps',
        'tipe_ps',
        'harga_per_jam',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'owner_id'
        );
    }
}