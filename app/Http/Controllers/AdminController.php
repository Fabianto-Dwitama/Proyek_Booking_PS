<?php

namespace App\Http\Controllers;

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

        $jumlahOwner = User::where(
            'role',
            'owner'
        )->count();

        $jumlahBooking = Booking::count();

        $jumlahPayment = Payment::count();

        return view(
            'admin.dashboard',
            compact(
                'jumlahUser',
                'jumlahOwner',
                'jumlahBooking',
                'jumlahPayment'
            )
        );
    }

    public function users()
    {
        $users = User::where(
            'role',
            'pembeli'
        )->get();

        return view(
            'admin.users',
            compact('users')
        );
    } 

    public function owners()
    {
        $owners = User::where(
            'role',
            'owner'
        )->get();

        return view(
            'admin.owners',
            compact('owners')
        );
    }

    public function bookings()
    {
        $bookings = Booking::latest()->get();

        return view(
            'admin.bookings',
            compact('bookings')
        );
    }

    public function transactions()
    {
        $payments = \App\Models\Payment::latest()->get();

        return view(
            'admin.transactions',
            compact('payments')
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