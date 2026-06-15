<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_phone',
        'playstation_id',
        'tanggal',
        'jam_mulai',
        'durasi',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function playstation()
    {
        return $this->belongsTo(
            Playstation::class
        );
    }

    public function payment()
    {
        return $this->hasOne(
            Payment::class
        );
    }
}