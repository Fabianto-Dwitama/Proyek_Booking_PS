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

@if(session('error'))
    <p style="color:red;">
        {{ session('error') }}
    </p>
@endif

<table border="1" cellpadding="10" cellspacing="0" width="100%">

    <tr>
        <th>No</th>
        <th>Playstation</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Durasi</th>
        <th>Total</th>
        <th>Status Booking</th>
        <th>Status Pembayaran</th>
    </tr>

    @foreach($bookings as $booking)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>
            {{ $booking->playstation->nomor_ps }}
            <br>
            <small>
                {{ $booking->playstation->tipe_ps }}
            </small>
        </td>

        <td>
            {{ $booking->tanggal_indonesia }}
        </td>

        <td>
            {{ $booking->jam_mulai }}
        </td>

        <td>
            {{ $booking->durasi }} Jam
        </td>

        <td>
            Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
        </td>

        <td>

            @if($booking->status == 'pending')

                <span style="color:orange;">
                    ⏳ Menunggu Verifikasi
                </span>

            @elseif($booking->status == 'confirmed')

                <span style="color:green;">
                    ✅ Dikonfirmasi
                </span>

            @else

                <span style="color:red;">
                    ❌ Dibatalkan
                </span>

            @endif

        </td>

        <td>

            @if($booking->payment)

                @if($booking->payment->status == 'pending')

                    <span style="color:orange;">
                        ⏳ Menunggu Verifikasi
                    </span>

                @elseif($booking->payment->status == 'verified')

                    <span style="color:green;">
                        ✅ Lunas
                    </span>

                @else

                    <span style="color:red;">
                        ❌ Ditolak
                    </span>

                @endif

            @else

                <a
                    href="{{ route('payments.create', ['booking_id' => $booking->id]) }}"
                    style="
                        background:#2563eb;
                        color:white;
                        padding:8px 12px;
                        text-decoration:none;
                        border-radius:4px;
                    "
                >
                    💳 Bayar Sekarang
                </a>

            @endif

        </td>

    </tr>

    @endforeach

</table>