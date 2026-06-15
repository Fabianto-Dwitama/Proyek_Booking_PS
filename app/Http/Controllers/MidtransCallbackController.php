<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Log::info(
            'PAYMENT VERIFIED',
            [
                'order_id' => $request->order_id
            ]
        );
        /*
        |--------------------------------------------------------------------------
        | Verifikasi Signature Midtrans
        |--------------------------------------------------------------------------
        */
        $serverKey = config('midtrans.server_key');

        $localSignature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($localSignature !== $request->signature_key) {

            Log::warning(
                'INVALID MIDTRANS SIGNATURE',
                [
                    'order_id' => $request->order_id
                ]
            );

            return response()->json([
                'message' => 'Invalid signature'
            ], 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Cari Payment
        |--------------------------------------------------------------------------
        */
        $payment = Payment::where(
            'transaction_id',
            $request->order_id
        )->first();

        if (!$payment) {

            Log::warning(
                'PAYMENT TIDAK DITEMUKAN',
                [
                    'order_id' => $request->order_id
                ]
            );

            return response()->json([
                'message' => 'Payment tidak ditemukan'
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Status Berhasil
        |--------------------------------------------------------------------------
        */
        if (
            in_array(
                $request->transaction_status,
                ['capture', 'settlement']
            )
        ) {

            if ($payment->status !== 'verified') {

                $payment->update([
                    'status' => 'verified'
                ]);

                $payment->booking()->update([
                    'status' => 'confirmed'
                ]);

                Log::info(
                    'PAYMENT VERIFIED',
                    [
                        'order_id' => $request->order_id
                    ]
                );
            }

            return response()->json([
                'success' => true
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Status Pending
        |--------------------------------------------------------------------------
        */
        elseif (
            $request->transaction_status === 'pending'
        ) {

            $payment->update([
                'status' => 'pending'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Status Gagal
        |--------------------------------------------------------------------------
        */
        elseif (
            in_array(
                $request->transaction_status,
                ['deny', 'expire', 'cancel']
            )
        ) {

            $payment->update([
                'status' => 'failed'
            ]);

            $payment->booking()->update([
                'status' => 'cancelled'
            ]);

            Log::warning(
                'PAYMENT FAILED',
                [
                    'order_id' => $request->order_id,
                    'status'   => $request->transaction_status
                ]
            );
        }

        return response()->json([
            'success' => true
        ]);
    }
}