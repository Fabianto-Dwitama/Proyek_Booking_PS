@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Riwayat Pembayaran</h1>

    <table border="1" cellpadding="10">

        <thead>
            <tr>
                <th>ID</th>
                <th>Booking</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Metode</th>
            </tr>
        </thead>

        <tbody>

            @forelse($payments as $payment)

                <tr>
                    <td>{{ $payment->id }}</td>

                    <td>
                        Booking #{{ $payment->booking_id }}
                    </td>

                    <td>
                        Rp {{ number_format($payment->nominal) }}
                    </td>

                    <td>

                        @if($payment->status == 'verified')

                            <span>
                                Verified
                            </span>

                        @elseif($payment->status == 'pending')

                            <span>
                                Pending
                            </span>

                        @else

                            <span>
                                Failed
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $payment->metode }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5">
                        Belum ada pembayaran
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>
@endsection