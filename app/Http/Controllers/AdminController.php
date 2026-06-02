<?php

namespace App\Http\Controllers;

use App\Models\Playstation;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function showOwner($id)
    {
        $owner = User::findOrFail($id);

        $jumlahPlaystation = Playstation::where(
            'owner_id',
            $owner->id
        )->count();

        $jumlahBooking = Booking::whereHas(
            'playstation',
            function ($q) use ($owner) {
                $q->where(
                    'owner_id',
                    $owner->id
                );
            }
        )->count();

        $pendapatan = Payment::where(
            'status',
            'verified'
        )
        ->whereHas(
            'booking.playstation',
            function ($q) use ($owner) {
                $q->where(
                    'owner_id',
                    $owner->id
                );
            }
        )
        ->sum('nominal');

        return view(
            'admin.owner-detail',
            compact(
                'owner',
                'jumlahPlaystation',
                'jumlahBooking',
                'pendapatan'
            )
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

    public function storeOwner(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'owner',
        ]);

        return back()->with(
            'success',
            'Owner berhasil ditambahkan'
        );
    }

    public function destroyOwner($id)
    {
        $owner = User::findOrFail($id);

        if ($owner->id == auth()->id()) {
            return back()->with(
                'success',
                'Tidak bisa menghapus akun sendiri'
            );
        }

        $owner->delete();

        return back()->with(
            'success',
            'Owner berhasil dihapus'
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