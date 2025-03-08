<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    </head>
    <body class="bg-#e0e0e2 animate-fade_in">
        @include('member.header')
        @include('member.sidebar')
        <div class="pb-16 animate-fade_in font-inter"> 
            <div class="px-10 mt-8 flex justify-between items-center">
                @isset($info)
                    <h1 class="font-inter text-3xl font-extrabold"> Home </h1>
                @endisset
                <!-- date and time section -->
                <div id="datetime" class="text-sm font-medium rounded-md bg-#cdcdcd-50 p-1.5"></div>
            </div>
            
            <div class="flex flex-wrap px-10 mt-6 font-inter">
                <div class="w-full mb-4">

                    <!-- IDK WHAT TO CALL THIS -->
                    <div class="w-full lg:grid lg:grid-cols-12 gap-4 mt-2">
                        <!-- idk what to call this -->
                        <div class="lg:col-span-8 bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-4 h-120 relative">
                            <img src="{{ asset('images/cover.jpg') }}" alt="Cover Image" class="w-full h-full object-cover rounded-md absolute inset-0">
                            <div class="absolute bottom-0 right-0 p-10">
                                <h1 class="font-inter text-3xl font-extrabold text-white text-right">Hello, {{ ucfirst($info->first_name) }}!</h1>
                                <p class="font-inter text-md font-semibold text-white text-right">Let's make today a productive day!</p>
                            </div>
                        </div>

                        <!-- NOTIFICATIONS -->
                        <div class="lg:col-span-4 bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-4 mt-4 lg:mt-0">
                            <div class="p-2">
                                <h1 class="underline font-bold text-lg mb-2">Notifications</h1>
                                @if($notification)
                                    <div class="bg-[#e6e6e6] p-3 mb-3 rounded-md shadow-md text-sm">
                                        <p class="font-medium">Welcome! You’ve been added to the '{{ $notification->organizations_name }}' organization by Manager {{ $notification->manager_name }}.</p>
                                        <p class="text-sm text-gray-500 mt-2">{{ \Carbon\Carbon::parse($notification->time)->format('F j, Y, g:i a') }}</p>
                                    </div>
                                @else
                                    <p>No notifications yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            function updateDateTime() {
                const dateTimeElement = document.getElementById('datetime');
                const now = new Date();
                const date = now.toLocaleDateString();  // date format (e.g., "12/8/2024")
                const time = now.toLocaleTimeString();  // time format (e.g., "12:34:56 PM")
                dateTimeElement.textContent = `${date}, ${time}`;
            }

            // update the date and time every second
            setInterval(updateDateTime, 1000);

            // initial call to set the time immediately
            updateDateTime();
        </script>

    </body>
</html>
