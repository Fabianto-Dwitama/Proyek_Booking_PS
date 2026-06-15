@extends('layouts.app')

@section('content')

<h1>Laporan Sistem</h1>

<a href="{{ route('admin.dashboard') }}">
    ← Kembali ke Dashboard
</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <td>Total Playstation</td>
        <td>{{ $totalPlaystations }}</td>
    </tr>

    <tr>
        <td>Total Booking</td>
        <td>{{ $totalBookings }}</td>
    </tr>

    <tr>
        <td>Total Payment Berhasil</td>
        <td>{{ $totalPayments }}</td>
    </tr>

    <tr>
        <td>Total Pendapatan</td>
        <td>
            Rp {{ number_format($totalRevenue) }}
        </td>
    </tr>

</table>

@endsection