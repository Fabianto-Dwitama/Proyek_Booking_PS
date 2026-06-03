<?php

namespace App\Http\Controllers;

use App\Models\Playstation;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $ownerId = auth()->id();

        $jumlahPlaystation = Playstation::where(
            'owner_id',
            $ownerId
        )->count();

        $jumlahBooking = Booking::whereHas(
            'playstation',
            function ($q) use ($ownerId) {
                $q->where('owner_id', $ownerId);
            }
        )->count();

        $bookingPending = Booking::where(
            'status',
            'pending'
        )
        ->whereHas(
            'playstation',
            function ($q) use ($ownerId) {
                $q->where('owner_id', $ownerId);
            }
        )
        ->count();

        $pendapatan = Payment::where(
            'status',
            'verified'
        )
        ->whereHas(
            'booking.playstation',
            function ($q) use ($ownerId) {
                $q->where('owner_id', $ownerId);
            }
        )
        ->sum('nominal');

        return view(
            'owner.dashboard',
            compact(
                'jumlahPlaystation',
                'jumlahBooking',
                'bookingPending',
                'pendapatan'
            )
        );
    }

    public function bookings()
    {
        $ownerId = auth()->id();

        $bookings = Booking::with([
            'user',
            'playstation'
        ])
        ->whereHas(
            'playstation',
            function ($q) use ($ownerId) {
                $q->where('owner_id', $ownerId);
            }
        )
        ->latest()
        ->get();

        return view(
            'owner.bookings',
            compact('bookings')
        );
    }

    public function payments()
    {
        $ownerId = auth()->id();

        $payments = Payment::with([
            'booking.user',
            'booking.playstation'
        ])
        ->whereHas(
            'booking.playstation',
            function ($q) use ($ownerId) {
                $q->where('owner_id', $ownerId);
            }
        )
        ->latest()
        ->get();

        return view(
            'owner.payments',
            compact('payments')
        );
    }

    public function verifyPayment(int $id)
    {
        $ownerId = auth()->id();

        $payment = Payment::whereHas(
            'booking.playstation',
            function ($q) use ($ownerId) {
                $q->where('owner_id', $ownerId);
            }
        )->findOrFail($id);

        $payment->update([
            'status' => 'verified'
        ]);

        Booking::where(
            'id',
            $payment->booking_id
        )->update([
            'status' => 'confirmed'
        ]);

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi'
        );
    }

    public function profile()
    {
        return view(
            'owner.profile',
            [
                'owner' => auth()->user()
            ]
        );
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->update([

            'whatsapp' => $request->whatsapp,

            'rekening_bca' => $request->rekening_bca,

            'rekening_bni' => $request->rekening_bni,

            'dana' => $request->dana,

            'gopay' => $request->gopay,

        ]);

        return back()->with(
            'success',
            'Data pembayaran berhasil diperbarui'
        );
    }
}