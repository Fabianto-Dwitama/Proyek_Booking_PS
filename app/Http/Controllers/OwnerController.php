<?php

namespace App\Http\Controllers;
use App\Models\Playstation;
use App\Models\Booking;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $jumlahPlaystation = Playstation::count();
        
        $jumlahBooking = Booking::count();

        return view(
            'owner.dashboard',
            compact('jumlahPlaystation', 'jumlahBooking')
        );
    }
}