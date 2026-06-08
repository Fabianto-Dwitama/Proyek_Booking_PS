<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'playstation_id',
        'tanggal',
        'jam_mulai',
        'durasi',
        'total_harga',
        'status',
    ];
}