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
        <th>Status</th>
        <th>Pembayaran</th>
    </tr>

    @foreach($bookings as $booking)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $booking->tanggal }}</td>

        <td>{{ $booking->tanggal_indonesia }}</td>

        <td>{{ $booking->durasi }} Jam</td>

        <td>
            Rp {{ number_format($booking->total_harga) }}
        </td>

        <td>
            @if($booking->status == 'pending')
                Menunggu Verifikasi
            @elseif($booking->status == 'confirmed')
                Dikonfirmasi
            @else
                Dibatalkan
            @endif
        </td>

        <td>

            <a
                href="/pembeli/payments/create?booking_id={{ $booking->id }}"
            >
                Upload Bukti
            </a>

        </td>

    </tr>

    @endforeach

</table>