<a
    href="{{ route('bookings.index') }}"
    style="
        background:#6b7280;
        color:white;
        padding:8px 12px;
        text-decoration:none;
        border-radius:4px;
    "
>
    ← Kembali ke Booking Saya
</a>

<br><br>

<h1>Upload Bukti Pembayaran</h1>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<form
    action="{{ route('payments.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    <p>
        Booking ID:
        <input
            type="number"
            name="booking_id"
            value="{{ $booking_id }}"
            readonly
        >
    </p>

    <p>
        Metode Pembayaran:
        <input
            type="text"
            name="metode"
            placeholder="Transfer BCA"
            required
        >
    </p>

    <p>
        Bukti Transfer:
        <input
            type="file"
            name="bukti_transfer"
            required
        >
    </p>

    <button type="submit">
        Upload Bukti
    </button>

</form>