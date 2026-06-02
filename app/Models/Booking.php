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

    public function playstation()
    {
        return $this->belongsTo(
            \App\Models\Playstation::class
        );
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(
            \App\Models\User::class
        );
    }

    public function owner()
    {
        return $this->playstation->owner;
    }
}