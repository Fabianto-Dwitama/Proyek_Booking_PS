<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $booking = Booking::with(
            'playstation.owner'
        )->findOrFail(
            $request->booking_id
        );

        return view(
            'pembeli.payments.create',
            compact('booking')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'metode' => 'required',
            'nominal' => 'required|numeric|min:1000',
        ]);

        Payment::create([
            'booking_id' => $request->booking_id,
            'metode' => $request->metode,
            'nominal' => $request->nominal,
            'status' => 'pending'
        ]);

        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Pembayaran berhasil dikirim. Silakan kirim bukti transfer ke WhatsApp Owner.'
            );
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
