<?php

namespace App\Http\Controllers;

use App\Models\Playstation;

class PembeliController extends Controller
{
    public function dashboard()
    {
        $playstations = Playstation::where(
            'status',
            'tersedia'
        )->get();

        return view(
            'pembeli.dashboard',
            compact('playstations')
        );
    }
}