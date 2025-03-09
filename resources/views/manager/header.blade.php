<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    </head>
    <body class="">
        <header class="font-inter fixed top-0 left-0 w-full bg-#e0e0e2 bg-opacity-80 py-3 border-b-header-stroke border-black border-opacity-20 z-10 backdrop-blur">
            <div class="flex items-center justify-between px-6">
                <!-- MENU BUTTON -->
                <button id="menu-button" class="focus:outline-none text-black hover:bg-#cdcdcd-50 hover:rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>
                </button>

                <!-- NAME OF ORGANIZATION -->
                <div class="relative">
                    @isset($info)
                        <span class="text-black text-sm font-semibold bg-#cdcdcd-50 px-2.5 py-1 rounded-full">{{ $info->organizations_name }}</span>
                    @endisset
                </div>
            </div>
        </header>

        <!-- Sidebar -->
        {{-- @include('manager.sidebar') --}}

        <div class="pt-16">
            @yield('content')
        </div>

        <!-- JavaScript for sidebar toggle -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const menuButton = document.getElementById('menu-button');
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                const closeButton = document.getElementById('close-button');

                // Ensure sidebar and overlay are visible by default
                //sidebar.classList.remove('-translate-x-full');
                //sidebar.classList.add('translate-x-0');
                //overlay.classList.remove('hidden');
                
                menuButton.addEventListener('click', function () {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('hidden');
                });

                closeButton.addEventListener('click', function () {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    overlay.classList.add('hidden');
                });

                overlay.addEventListener('click', function () {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                    overlay.classList.add('hidden');
                });
            });
        </script>

    </body>
</html>
