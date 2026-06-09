<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $transactionStatus =
            $request->transaction_status;

        $orderId =
            $request->order_id;

        $payment = Payment::where(
            'transaction_id',
            $orderId
        )->first();

        if (!$payment) {
            return response()->json([
                'message' => 'Payment tidak ditemukan'
            ], 404);
        }

        if (
            $transactionStatus == 'settlement'
            ||
            $transactionStatus == 'capture'
        ) {

            $payment->update([
                'status' => 'verified'
            ]);

            $payment->booking()->update([
                'status' => 'confirmed'
            ]);
        }

        if (
            $transactionStatus == 'cancel'
            ||
            $transactionStatus == 'expire'
            ||
            $transactionStatus == 'deny'
        ) {

            $payment->update([
                'status' => 'rejected'
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}