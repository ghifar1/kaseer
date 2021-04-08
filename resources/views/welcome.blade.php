<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- fontawesome -->
        <script src="https://kit.fontawesome.com/92db03e8f6.js" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased overflow-x-hidden " >
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex w-full">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                        </a>
                    </div>

                    <div class="flex w-full justify-end">
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                Login
                            </x-nav-link>

                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                Register
                            </x-nav-link>

                        </div>
                    </div>

                </div>



                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>


            </div>
        </div>
    </nav>
    <div class="w-screen">
        <div id="bg-front" class="absolute w-full h-1/2" style="z-index: -999">

        </div>
        <div class="mx-5 sm:mx-32 pt-14">
            <div class="font-bold text-6xl sm:text-8xl ">
                KASEER
            </div>
            <div class="mx-1 sm:text-xl">
                Kasir online untuk kebutuhan warung Anda
            </div>
            <div class="flex flex-wrap justify-center mt-6 sm:mt-16">
                <div class="bg-green-200 w-56 rounded-md p-3 m-3 text-center font-bold">
                    <i class="fas fa-calculator fa-3x"></i>
                    <p>Penghitung Otomatis</p>
                </div>
                <div class="bg-green-100 w-56 rounded-md p-3 m-3 text-center font-bold">
                    <i class="fas fa-file-invoice fa-3x"></i>
                    <p>Laporan Bulanan</p>
                </div>
                <div class="bg-green-200 w-56 rounded-md p-3 m-3 text-center font-bold">
                    <i class="fas fa-box-open fa-3x"></i>
                    <p>Tambah / Kurangi Stok</p>
                </div>
            </div>
        </div>
    </div>

    <div class="relative sm:absolute bottom-2 font-bold text-center w-full">
        <p>Copyright 2021 Ghifari</p>
    </div>

    <!-- fantajs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js"></script>
    <script>
        VANTA.GLOBE({
            el: "#bg-front",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x3fff55,
            color2: 0x1670f2,
            size: 0.80,
            backgroundColor: 0xffffff
        })
    </script>
    </body>
</html>
