<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\User;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with([
            'booking.playstation'
        ])
        ->latest()
        ->get();

        return view(
            'pembeli.payments.index',
            compact('payments')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $booking = Booking::with(
            'playstation'
        )->findOrFail(
            $request->booking_id
        );

        $owner = User::where(
            'role',
            'owner'
        )->first();

        if (
            !$owner ||
            (
                !$owner->rekening_bca &&
                !$owner->rekening_bni &&
                !$owner->dana &&
                !$owner->gopay
            )
        ) {

            return redirect()
                ->route('bookings.index')
                ->with(
                    'error',
                    'Owner belum mengatur metode pembayaran.'
                );

        }

        return view(
            'pembeli.payments.create',
            compact(
                'booking',
                'owner'
            )
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

            'bukti_transfer' =>
                'required|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $existingPayment = Payment::where(
            'booking_id',
            $request->booking_id
        )->first();

        if ($existingPayment) {

            return back()->with(
                'error',
                'Pembayaran untuk booking ini sudah pernah dibuat.'
            );

        }

        $path = $request->file(
            'bukti_transfer'
        )->store(
            'bukti-transfer',
            'public'
        );

        Payment::create([

            'booking_id' => $request->booking_id,

            'metode' => $request->metode,

            'nominal' => $request->nominal,

            'bukti_transfer' => $path,

            'status' => 'pending',

        ]);

        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Pembayaran berhasil dikirim dan menunggu verifikasi owner.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with([
            'booking.playstation'
        ])->findOrFail($id);

        return view(
            'pembeli.payments.show',
            compact('payment')
        );
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
        $payment = Payment::findOrFail($id);

        if ($payment->bukti_transfer) {

            $file = public_path(
                'storage/' .
                $payment->bukti_transfer
            );

            if (file_exists($file)) {
                unlink($file);
            }

        }

        $payment->delete();

        return back()->with(
            'success',
            'Pembayaran berhasil dihapus.'
        );
    }
}