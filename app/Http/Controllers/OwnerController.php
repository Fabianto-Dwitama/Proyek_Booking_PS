<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Playstation;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $jumlahPlaystation = Playstation::count();

        $jumlahBooking = Booking::count();

        $jumlahTersedia = Playstation::where(
            'status',
            'tersedia'
        )->count();

        $jumlahMaintenance = Playstation::where(
            'status',
            'maintenance'
        )->count();

        $totalPendapatan = Booking::where(
            'status',
            'confirmed'
        )->sum(
            'total_harga'
        );

        return view(
            'owner.dashboard',
            compact(
                'jumlahPlaystation',
                'jumlahBooking',
                'jumlahTersedia',
                'jumlahMaintenance',
                'totalPendapatan'
            )
        );
    }
}