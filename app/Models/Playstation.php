<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playstation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_ps',
        'tipe_ps',
        'harga_per_jam',
        'status',
    ];
}
