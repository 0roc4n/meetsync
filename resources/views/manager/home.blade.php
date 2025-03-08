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
        @include('manager.header')
        @include('manager.sidebar')
        
        <div class="pb-16 animate-fade_in font-inter"> 
            <div class="px-10 mt-8 flex justify-between items-center">
                @isset($info)
                    <h1 class="font-inter text-3xl font-extrabold"> Home<!--Hello, {{ $info->first_name }}!--></h1>
                @endisset
                <!-- date and time section -->
                <div id="datetime" class="text-sm font-medium rounded-md bg-#cdcdcd-50 p-1.5"></div>
            </div>
            
            <div class="flex flex-wrap px-10 mt-7 font-inter">
                <div class="w-full mb-4">
                    <!-- 3 cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h1 class="font-semibold text-3xl mb-1">{{ $members_count }}</h1>
                                    <p class="text-gray-600 text-sm">Number of {{ $manager->organizations_name }} members</p>
                                </div>
                                <div class="bg-#333333-60 p-1.5 rounded-full">
                                    <img src="{{ asset('images/members.svg') }}" alt="Members" class="h-8 w-8">
                                </div>
                            </div>
                        </div>
                        <div class="bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h1 class="font-semibold text-3xl mb-1">{{ $pending_meetings_count }}</h1>
                                    <p class="text-gray-600 text-sm">Number of {{ $manager->organizations_name }} pending meetings</p>
                                </div>
                                <div class="bg-#333333-60 p-1.5 rounded-full">
                                    <img src="{{ asset('images/meetings.svg') }}" alt="Meetings" class="h-8 w-8">
                                </div>
                            </div>
                        </div>
                        <div class="bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h1 class="font-semibold text-3xl mb-1">{{ $done_meetings_count }}</h1>
                                    <p class="text-gray-600 text-sm">Number of {{ $manager->organizations_name }} done meetings</p>
                                </div>

                                <div class="bg-#333333-60 p-1.5 rounded-full">
                                    <img src="{{ asset('images/meetings.svg') }}" alt="Meetings" class="h-8 w-8">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- IDK WHAT TO CALL THIS -->
                    <div class="w-full lg:grid lg:grid-cols-12 gap-4 mt-4">
                        <!-- idk what to call this -->
                        <div class="lg:col-span-8 bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-4 h-120 relative">
                            <img src="{{ asset('images/cover.jpg') }}" alt="Cover Image" class="w-full h-full object-cover rounded-md absolute inset-0">
                            <div class="absolute bottom-0 right-0 p-10">
                                <h1 class="font-inter text-3xl font-extrabold text-white text-right">Hello, {{ $info->first_name }}!</h1>
                                <p class="font-inter text-md font-semibold text-white text-right">Let's make today a great day for your team!</p>
                            </div>
                        </div>

                        <!-- NOTIFICATIONS -->
                        <div class="lg:col-span-4 bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-4 mt-4 lg:mt-0">
                            <div class="p-2">
                                <h1 class="underline font-bold text-lg mb-2">Notifications</h1> 
                                <!-- loop through notifications and display them -->
                                @foreach ($notifications as $notification)
                                    <div class="bg-[#e6e6e6] p-3 mb-3 rounded-md shadow-md">
                                        <p class="font-medium text-gray-700 text-sm">
                                            <strong>{{ $notification->member_name }}</strong> approved the notes for the meeting
                                            <strong>{{ $notification->meeting_name }}</strong>.
                                        </p>
                                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($notification->time)->format('F j, Y, g:i A') }}</p>
                                    </div>
                                @endforeach

                                @if ($notifications->isEmpty())
                                    <p class="text-gray-500">No notifications yet.</p>
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
