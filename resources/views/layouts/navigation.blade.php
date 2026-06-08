@php
$role = Auth::user()->role;
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">

        <!-- Logo + Menu -->
        <div class="flex">

            <div class="shrink-0 flex items-center">
                <a href="#">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                @if($role == 'admin')

                    <x-nav-link
                        :href="url('/admin/dashboard')"
                        :active="request()->is('admin/dashboard')">
                        📊 Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="url('/admin/users')"
                        :active="request()->is('admin/users')">
                        👥 User
                    </x-nav-link>

                    <x-nav-link
                        :href="url('/admin/owners')"
                        :active="request()->is('admin/owners')">
                        🏢 Owner
                    </x-nav-link>

                    <x-nav-link
                        :href="url('/admin/bookings')"
                        :active="request()->is('admin/bookings')">
                        📅 Booking
                    </x-nav-link>

                    <x-nav-link
                        :href="url('/admin/transactions')"
                        :active="request()->is('admin/transactions')">
                        💳 Transaksi
                    </x-nav-link>

                @endif


                @if($role == 'owner')

                    <x-nav-link
                        :href="url('/owner/dashboard')"
                        :active="request()->is('owner/dashboard')">
                        📊 Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('playstations.index')"
                        :active="request()->is('owner/playstations*')">
                        🎮 Playstation
                    </x-nav-link>

                    <x-nav-link
                        :href="url('/owner/bookings')"
                        :active="request()->is('owner/bookings')">
                        📅 Booking
                    </x-nav-link>

                    <x-nav-link
                        :href="url('/owner/payments')"
                        :active="request()->is('owner/payments*')">
                        💰 Pembayaran
                    </x-nav-link>

                @endif


                @if($role == 'pembeli')

                    <x-nav-link
                        :href="url('/pembeli/dashboard')"
                        :active="request()->is('pembeli/dashboard')">
                        📊 Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('bookings.create')"
                        :active="request()->routeIs('bookings.create')">
                        🎮 Booking PS
                    </x-nav-link>

                    <x-nav-link
                        :href="route('bookings.index')"
                        :active="request()->routeIs('bookings.index')">
                        📋 Booking Saya
                    </x-nav-link>

                @endif

            </div>
        </div>

        <!-- User Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">

            <x-dropdown align="right" width="48">

                <x-slot name="trigger">

                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>

                    </button>

                </x-slot>

                <x-slot name="content">

                    <x-dropdown-link :href="route('profile.edit')">
                        👤 Profile
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link
                            :href="route('logout')"
                            onclick="event.preventDefault();
                                     this.closest('form').submit();">

                            🚪 Log Out

                        </x-dropdown-link>

                    </form>

                </x-slot>

            </x-dropdown>

        </div>

        <!-- Mobile Button -->
        <div class="-me-2 flex items-center sm:hidden">

            <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">

                <svg class="h-6 w-6"
                     stroke="currentColor"
                     fill="none"
                     viewBox="0 0 24 24">

                    <path
                        :class="{'hidden': open, 'inline-flex': !open}"
                        class="inline-flex"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>

                    <path
                        :class="{'hidden': !open, 'inline-flex': open}"
                        class="hidden"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>

                </svg>

            </button>

        </div>

    </div>
</div>

<!-- Mobile Menu -->
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

    <div class="pt-2 pb-3 space-y-1">

        @if($role == 'admin')

            <x-responsive-nav-link :href="url('/admin/dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/admin/users')">
                User
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/admin/owners')">
                Owner
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/admin/bookings')">
                Booking
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/admin/transactions')">
                Transaksi
            </x-responsive-nav-link>

        @endif

        @if($role == 'owner')

            <x-responsive-nav-link :href="url('/owner/dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('playstations.index')">
                Playstation
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/owner/bookings')">
                Booking
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/owner/payments')">
                Pembayaran
            </x-responsive-nav-link>

        @endif

        @if($role == 'pembeli')

            <x-responsive-nav-link :href="url('/pembeli/dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('bookings.create')">
                Booking PS
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('bookings.index')">
                Booking Saya
            </x-responsive-nav-link>

        @endif

    </div>

</div>

</nav>
