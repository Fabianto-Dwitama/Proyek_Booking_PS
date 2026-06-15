<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Playstation;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function reports()
    {
        return view('admin.reports', [

            'totalPlaystations' =>
                Playstation::count(),

            'totalBookings' =>
                Booking::count(),

            'totalPayments' =>
                Payment::count(),

            'totalRevenue' =>
                Booking::where(
                    'status',
                    'confirmed'
                )->sum(
                    'total_harga'
                ),

        ]);
    }
}