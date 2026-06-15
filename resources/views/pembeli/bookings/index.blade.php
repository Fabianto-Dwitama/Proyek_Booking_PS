```blade
<a
    href="/pembeli/dashboard"
    style="
        background:#6b7280;
        color:white;
        padding:8px 12px;
        text-decoration:none;
        border-radius:4px;
    "
>
    ← Kembali ke Dashboard
</a>

<br><br>

<h1>Daftar Booking Saya</h1>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Durasi</th>
        <th>Total</th>
        <th>Status Booking</th>
        <th>Pembayaran</th>
    </tr>

    @foreach($bookings as $booking)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $booking->tanggal }}</td>

        <td>{{ $booking->jam_mulai }}</td>

        <td>{{ $booking->durasi }} Jam</td>

        <td>
            Rp {{ number_format($booking->total_harga) }}
        </td>

        <td>

            @if($booking->status === 'confirmed')

                <span style="color:green;font-weight:bold;">
                    Confirmed
                </span>

            @elseif($booking->status === 'pending')

                <span style="color:orange;font-weight:bold;">
                    Pending
                </span>

            @elseif($booking->status === 'cancelled')

                <span style="color:red;font-weight:bold;">
                    Cancelled
                </span>

            @else

                {{ $booking->status }}

            @endif

        </td>

        <td>

            @if($booking->status === 'confirmed')

                <span style="color:green;font-weight:bold;">
                    Sudah Dibayar
                </span>

            @else

                <a
                    href="/pembeli/payments/create?booking_id={{ $booking->id }}"
                >
                    Bayar Sekarang
                </a>

            @endif

        </td>

    </tr>

    @endforeach

</table>
```
