<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

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
    $payments = Payment::with('booking')
    ->latest()
    ->get();

    foreach ($payments as $payment) {

        if ($payment->status === 'pending') {

            $this->syncPaymentStatus(
                $payment
            );
        }
    }

    $payments = Payment::with('booking')
        ->latest()
        ->get();

    return view(
        'pembeli.payments.index',
        compact('payments')
    );

    }

    private function syncPaymentStatus(
    Payment $payment
    )
    {
    try {

        $status = Transaction::status(
            $payment->transaction_id
        );

        if (
            in_array(
                $status->transaction_status,
                ['capture', 'settlement']
            )
        ) {

            $payment->update([
                'status' => 'verified'
            ]);

            $payment->booking()->update([
                'status' => 'confirmed'
            ]);
        }

        elseif (
            in_array(
                $status->transaction_status,
                ['deny', 'expire', 'cancel']
            )
        ) {

            $payment->update([
                'status' => 'failed'
            ]);

            $payment->booking()->update([
                'status' => 'cancelled'
            ]);
        }

    } catch (\Exception $e) {

        \Log::error(
            'MIDTRANS SYNC ERROR',
            [
                'transaction_id' =>
                    $payment->transaction_id,
                'message' =>
                    $e->getMessage()
            ]
        );
    }
}

    /**
     * Halaman pembayaran.
     */
    public function create(Request $request)
    {
        $booking = Booking::with('user')
            ->where('id', $request->booking_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (
            auth()->user()->hasRole('pembeli')
            && $booking->user_id !== auth()->id()
        ) {
            abort(403);
        }

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

    $booking = Booking::with('user')
        ->where('id', $request->booking_id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    if (
        $booking->user_id &&
        $booking->user_id !== auth()->id()
    ) {
        abort(403);
    }

    $existingPayment = Payment::where(
        'booking_id',
        $booking->id
    )
    ->whereIn('status', [
        'pending',
        'verified'
    ])
    ->latest()
    ->first();

    if ($existingPayment) {

        return view(
            'pembeli.payments.snap',
            [
                'payment' => $existingPayment
            ]
        );
    }

    $orderId =
        'BOOKING-' .
        $booking->id .
        '-' .
        time();

    $params = [

        'transaction_details' => [

            'order_id' => $orderId,

            'gross_amount' => (int) $booking->total_harga,

        ],

        'customer_details' => [

            'first_name' =>
                $booking->user?->name
                ?? 'Guest',

            'email' =>
                $booking->user?->email
                ?? 'guest@example.com',

        ],

    ];

    \Log::info(
        'MIDTRANS PARAMS',
        $params
    );

    try {

        $snapToken = Snap::getSnapToken(
            $params
        );

    } catch (\Exception $e) {

        \Log::error(
            'MIDTRANS SNAP ERROR',
            [
                'message' => $e->getMessage()
            ]
        );

        return back()->with(
            'error',
            $e->getMessage()
        );
    }

    $payment = Payment::create([

        'booking_id' => $booking->id,

        'metode' => 'Midtrans',

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

    public function syncStatus(Payment $payment)
    {
        try {

            $status = Transaction::status(
                $payment->transaction_id
            );

            if (
                in_array(
                    $status->transaction_status,
                    ['capture', 'settlement']
                )
            ) {

                $payment->update([
                    'status' => 'verified'
                ]);

                $payment->booking()->update([
                    'status' => 'confirmed'
                ]);
            }

            elseif (
                in_array(
                    $status->transaction_status,
                    ['deny', 'expire', 'cancel']
                )
            ) {

                $payment->update([
                    'status' => 'failed'
                ]);

                $payment->booking()->update([
                    'status' => 'cancelled'
                ]);
            }

            return back()->with(
                'success',
                'Status berhasil disinkronkan'
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
}