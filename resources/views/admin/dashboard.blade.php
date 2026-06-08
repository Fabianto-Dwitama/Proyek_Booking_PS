<<<<<<< HEAD
@extends('layouts.admin')

@section('content')

<!-- STATISTIC -->
<div class="grid grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">

        <p class="text-slate-500 text-sm">
            Total Booking
        </p>

        <h2 class="text-3xl font-bold mt-3">
            24
        </h2>

        <p class="text-green-500 text-sm mt-2">
            +12% dari kemarin
        </p>

    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">

        <p class="text-slate-500 text-sm">
            Pendapatan Hari Ini
        </p>

        <h2 class="text-3xl font-bold mt-3">
            Rp1.250.000
        </h2>

        <p class="text-green-500 text-sm mt-2">
            +18% dari kemarin
        </p>

    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">

        <p class="text-slate-500 text-sm">
            PS Aktif
        </p>

        <h2 class="text-3xl font-bold mt-3">
            8 Unit
        </h2>

        <p class="text-slate-500 text-sm mt-2">
            dari 10 Unit
        </p>

    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">

        <p class="text-slate-500 text-sm">
            Maintenance
        </p>

        <h2 class="text-3xl font-bold mt-3">
            2 Unit
        </h2>

        <p class="text-red-500 text-sm mt-2">
            Perlu pengecekan
        </p>

    </div>

</div>

<!-- TABLE + STATUS -->
<div class="grid grid-cols-3 gap-6">

    <!-- TABLE -->
    <div class="col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-slate-200">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-bold">
                Booking Hari Ini
            </h2>

            <button class="text-blue-600 font-medium">
                Lihat Semua
            </button>

        </div>

        <table class="w-full">

            <thead>

                <tr class="text-left text-slate-500 border-b">

                    <th class="pb-4">Pelanggan</th>
                    <th class="pb-4">PS</th>
                    <th class="pb-4">Jam</th>
                    <th class="pb-4">Status</th>

                </tr>

            </thead>

            <tbody>

                <tr class="border-b">

                    <td class="py-5">Andi Setiawan</td>
                    <td>PS 5 VIP</td>
                    <td>13:00</td>

                    <td>
                        <span
                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-600 text-sm">

                            Berlangsung

                        </span>
                    </td>

                </tr>

                <tr class="border-b">

                    <td class="py-5">Rama Maulana</td>
                    <td>PS 4 Room</td>
                    <td>15:00</td>

                    <td>
                        <span
                            class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-sm">

                            Selesai

                        </span>
                    </td>

                </tr>

                <tr>

                    <td class="py-5">Fajar Nugroho</td>
                    <td>PS 3 Room</td>
                    <td>17:00</td>

                    <td>
                        <span
                            class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-sm">

                            Menunggu

                        </span>
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <!-- STATUS -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200">

        <h2 class="text-xl font-bold mb-6">
            Status PlayStation
        </h2>

        <div class="space-y-4">

            <div class="p-4 rounded-2xl border">

                <div class="flex justify-between">

                    <h3 class="font-semibold">
                        PS 5 VIP Room
                    </h3>

                    <span class="text-green-500 text-sm">
                        Digunakan
                    </span>

                </div>

            </div>

            <div class="p-4 rounded-2xl border">

                <div class="flex justify-between">

                    <h3 class="font-semibold">
                        PS 4 Room
                    </h3>

                    <span class="text-blue-500 text-sm">
                        Tersedia
                    </span>

                </div>

            </div>

            <div class="p-4 rounded-2xl border">

                <div class="flex justify-between">

                    <h3 class="font-semibold">
                        PS 3 Room
                    </h3>

                    <span class="text-red-500 text-sm">
                        Maintenance
                    </span>

                </div>
=======
<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard Admin</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded shadow">

                <h3 class="text-lg font-bold">
                    Selamat Datang Admin
                </h3>

                <p>
                    Monitoring sistem Booking Rental Playstation.
                </p>
>>>>>>> 93fe63300221a71f78a109423f62e7992856f6c8

            </div>

        </div>
<<<<<<< HEAD

    </div>

</div>

@endsection
=======
    </div>
</x-app-layout>
>>>>>>> 93fe63300221a71f78a109423f62e7992856f6c8
