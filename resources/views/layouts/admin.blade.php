<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')

    <title>Playboximy Dashboard</title>
</head>

<body class="bg-slate-100 font-sans text-slate-800">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-gradient-to-b from-slate-950 to-slate-900 text-white p-6">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-10">
            <div class="w-10 h-10 rounded-xl bg-blue-600"></div>

            <div>
                <h1 class="text-xl font-bold">
                    Playboximy
                </h1>

                <p class="text-slate-400 text-sm">
                    Gaming SaaS
                </p>
            </div>
        </div>

        <!-- MENU -->
        <nav class="space-y-3">

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-blue-600 shadow-lg shadow-blue-600/20">

                Dashboard
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition">

                Booking
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition">

                PlayStation
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition">

                Pelanggan
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition">

                Pendapatan
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition">

                Laporan
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-800 transition">

                Pengaturan
            </a>

        </nav>

        <!-- PROFILE -->
        <div class="mt-16 p-4 rounded-3xl bg-slate-900 border border-slate-800">

            <p class="text-sm text-slate-400">
                Owner
            </p>

            <h2 class="font-semibold mt-1">
                Raja PS Center
            </h2>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8 overflow-hidden">

        <!-- TOPBAR -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h1 class="text-3xl font-bold">
                    Dashboard Owner
                </h1>

                <p class="text-slate-500 mt-1">
                    Selamat datang kembali 👋
                </p>
            </div>

            <button
                class="px-5 py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium hover:scale-105 transition">

                Export Laporan
            </button>

        </div>

        @yield('content')

    </main>

</div>

</body>
</html>