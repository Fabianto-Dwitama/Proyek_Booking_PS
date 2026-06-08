<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'owner_id',
        'nama_rental',
        'alamat',
        'jam_buka',
        'jam_tutup'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function playstations()
    {
        return $this->hasMany(Playstation::class);
    }
}