<?php

namespace App\Http\Controllers;

use App\Models\Playstation;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jumlahUser = User::where(
            'role',
            'pembeli'
        )->count();

        $jumlahPlaystation = Playstation::count();

        $jumlahBooking = Booking::count();

        $jumlahPayment = Payment::count();

        $pendapatan = Payment::where(
            'status',
            'verified'
        )->sum('nominal');

        return view(
            'admin.dashboard',
            compact(
                'jumlahUser',
                'jumlahPlaystation',
                'jumlahBooking',
                'jumlahPayment',
                'pendapatan'
            )
        );
    }

    public function users()
    {
        $users = User::where(
            'role',
            'pembeli'
        )
        ->latest()
        ->get();

        return view(
            'admin.users',
            compact('users')
        );
    }

    public function bookings()
    {
        $bookings = Booking::with([
            'user',
            'playstation'
        ])
        ->latest()
        ->get();

        return view(
            'admin.bookings',
            compact('bookings')
        );
    }

    public function transactions()
    {
        $payments = Payment::with([
            'booking.user',
            'booking.playstation'
        ])
        ->latest()
        ->get();

        return view(
            'admin.transactions',
            compact('payments')
        );
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == auth()->id()) {

            return back()->with(
                'success',
                'Tidak bisa menghapus akun sendiri'
            );

        }

        $user->delete();

        return back()->with(
            'success',
            'User berhasil dihapus'
        );
    }

    public function destroyBooking($id)
    {
        Booking::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Booking berhasil dihapus'
        );
    }
}