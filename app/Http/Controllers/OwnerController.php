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
        $jumlahPlaystation = Playstation::count();

        $jumlahBooking = Booking::count();

        $bookingPending = Booking::where(
            'status',
            'pending'
        )->count();

        $pendapatan = Payment::where(
            'status',
            'verified'
        )->sum('nominal');

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
        $bookings = Booking::with([
            'user',
            'playstation',
            'payment'
        ])
        ->latest()
        ->get();

        return view(
            'owner.bookings',
            compact('bookings')
        );
    }

    public function payments()
    {
        $payments = Payment::with([
            'booking.user',
            'booking.playstation'
        ])
        ->latest()
        ->get();

        return view(
            'owner.payments',
            compact('payments')
        );
    }

    public function verifyPayment($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'verified'
        ]);

        if ($payment->booking) {

            $payment->booking->update([
                'status' => 'confirmed'
            ]);

        }

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi'
        );
    }

    public function rejectPayment($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'rejected'
        ]);

        if ($payment->booking) {

            $payment->booking->update([
                'status' => 'pending'
            ]);

        }

        return back()->with(
            'success',
            'Pembayaran berhasil ditolak'
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
        $request->validate([
            'nama_rental' => 'nullable|string|max:255',
            'alamat_rental' => 'nullable|string',
            'deskripsi_rental' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:20',
            'rekening_bca' => 'nullable|string|max:255',
            'rekening_bni' => 'nullable|string|max:255',
            'dana' => 'nullable|string|max:255',
            'gopay' => 'nullable|string|max:255',
        ]);

        auth()->user()->update([
            'nama_rental' => $request->nama_rental,
            'alamat_rental' => $request->alamat_rental,
            'deskripsi_rental' => $request->deskripsi_rental,
            'whatsapp' => $request->whatsapp,
            'rekening_bca' => $request->rekening_bca,
            'rekening_bni' => $request->rekening_bni,
            'dana' => $request->dana,
            'gopay' => $request->gopay,
        ]);

        return back()->with(
            'success',
            'Profil rental berhasil diperbarui'
        );
    }
}