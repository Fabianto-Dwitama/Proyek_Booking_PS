<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;

class PembeliController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $totalBooking = Booking::where(
            'user_id',
            $user->id
        )->count();

        $bookingAktif = Booking::where(
            'user_id',
            $user->id
        )->where(
            'status',
            'confirmed'
        )->count();

        $totalPengeluaran = Booking::where(
            'user_id',
            $user->id
        )->whereHas(
            'payment',
            function ($q) {
                $q->where('status', 'verified');
            }
        )->sum('total_harga');

        return view(
            'pembeli.dashboard',
            compact(
                'totalBooking',
                'bookingAktif',
                'totalPengeluaran'
            )
        );
    }
}