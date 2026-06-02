<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getTanggalIndonesiaAttribute()
    {
    return Carbon::parse($this->tanggal)
        ->format('d-m-Y');
    }
}