<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Playstation;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBooking = Booking::count();

        $totalPlaystation = Playstation::count();

        $totalPayment = Payment::where(
            'status',
            'verified'
        )->count();

        $totalRevenue = Booking::where(
            'status',
            'confirmed'
        )->sum(
            'total_harga'
        );

        $latestBookings = Booking::with([
            'user',
            'playstation'
        ])
        ->latest()
        ->take(5)
        ->get();

        return view(
            'admin.dashboard',
            compact(
                'totalBooking',
                'totalPlaystation',
                'totalPayment',
                'totalRevenue',
                'latestBookings'
            )
        );
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