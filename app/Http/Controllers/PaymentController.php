<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config(
            'midtrans.server_key'
        );

        Config::$isProduction = config(
            'midtrans.is_production'
        );

        Config::$isSanitized = true;

        Config::$is3ds = true;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Halaman pembayaran.
     */
    public function create(Request $request)
    {
        $booking = Booking::with(
            'user'
        )->findOrFail(
            $request->booking_id
        );

        return view(
            'pembeli.payments.create',
            compact('booking')
        );
    }

    /**
     * Generate transaksi Midtrans.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required'
        ]);

        $booking = Booking::with(
            'user'
        )->findOrFail(
            $request->booking_id
        );

        $orderId =
            'BOOKING-' .
            $booking->id .
            '-' .
            time();

        $params = [

            'transaction_details' => [

                'order_id' => $orderId,

                'gross_amount' => $booking->total_harga,

            ],

            'customer_details' => [

                'first_name' => $booking->user->name,

                'email' => $booking->user->email,

            ],

        ];

        $snapToken =
            Snap::getSnapToken(
                $params
            );

        $payment = Payment::create([

            'booking_id' => $booking->id,

            'metode' => 'Midtrans',

            'nominal' => $booking->total_harga,

            'status' => 'pending',

            'transaction_id' => $orderId,

            'snap_token' => $snapToken,

        ]);

        return view(
            'pembeli.payments.snap',
            compact('payment')
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
     * Update the specified resource.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        //
    }
}