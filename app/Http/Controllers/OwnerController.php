<?php

namespace App\Http\Controllers;
use App\Models\Playstation;
use App\Models\Booking;
use App\Models\Payment;

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

    public function bookings()
    {
        $bookings = Booking::latest()->get();

        return view(
            'owner.bookings',
            compact('bookings')
        );
    }

    public function payments()
    {
        $payments = Payment::latest()->get();

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
}