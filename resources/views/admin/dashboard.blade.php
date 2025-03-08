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
        @include('admin.header')
        @include('admin.sidebar')

        <div class="pb-16 animate-fade_in">
            <div class="px-10 mt-8 flex justify-between items-center">
                @isset($info)
                    <h1 class="font-inter text-3xl font-extrabold"> Hello, Admin {{ $info->first_name }}!</h1>
                @endisset
                <!-- date and time section -->
                <div id="datetime" class="text-sm font-medium rounded-md bg-#cdcdcd-50 p-1.5"></div>
            </div>

            @if(session('success'))
                <div class="px-10 mt-4">
                    <div id="success-alert" class="bg-green-500 text-white p-4 rounded">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- -->
            <div class="flex flex-wrap px-10 mt-7 font-inter">
                <div class="w-full grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                    <!-- 4 cards -->
                    <div class="bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-6">
                        <h2 class="mb-5 flex">
                            <div class="bg-#333333-60 p-1.5 rounded-full">
                                <img src="{{ asset('images/managers.svg') }}" alt="Managers" class="h-8 w-8">
                            </div>
                        </h2>
                        <h1 class="font-semibold text-3xl mb-1">{{ $managers_count }}</h1>
                        <p class="text-gray-600 text-sm">Number of managers</p>
                    </div>
                    <div class="bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-6">
                        <h2 class="mb-5 flex">
                            <div class="bg-#333333-60 p-1.5 rounded-full">
                                <img src="{{ asset('images/members.svg') }}" alt="Members" class="h-8 w-8">
                            </div>
                        </h2>
                        <h1 class="font-semibold text-3xl mb-1">{{ $members_count }}</h1>
                        <p class="text-gray-600 text-sm">Number of members</p>
                    </div>
                    <div class="bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-6">
                        <h2 class="mb-5 flex">
                            <div class="bg-#333333-60 p-1.5 rounded-full">
                                <img src="{{ asset('images/meetings.svg') }}" alt="Meetings" class="h-8 w-8">
                            </div>
                        </h2>
                        <h1 class="font-semibold text-3xl mb-1">{{ $meetings_count }}</h1>
                        <p class="text-gray-600 text-sm">Number of meetings</p>
                    </div>
                    <div class="bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-6">
                        <h2 class="mb-5 flex">
                            <div class="bg-#333333-60 p-1.5 rounded-full">
                                <img src="{{ asset('images/pendingusers.svg') }}" alt="pendingusers" class="h-8 w-8">
                            </div>
                        </h2>
                        <h1 class="font-semibold text-3xl mb-1">{{ $pending_users_count }}</h1>
                        <p class="text-gray-600 text-sm">Number of pending users</p>
                    </div>
                </div>

                <!-- requests and activity logs -->

                <div class="w-full lg:grid lg:grid-cols-12 gap-4 mt-4">
                    <!-- requests -->
                    <div class="lg:col-span-8 bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-4 h-120">
                        <div class="p-2">
                            <!-- title -->
                            <h1 class="underline font-bold text-lg mb-2">Pending Users</h1>
                            <!-- filter -->
                            <div class="flex w-full max-w-45 justify-end mb-4">
                                <div class="inline-flex items-center rounded-md bg-#e0e0e2 p-1.5">
                                    <button id="filter-all" class="rounded px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-gray-200">
                                        All
                                    </button>
                                    <button id="filter-managers" class="rounded px-3 py-1 text-xs font-medium text-black hover:bg-gray-200">
                                        Managers
                                    </button>
                                    <button id="filter-members" class="rounded px-3 py-1 text-xs font-medium text-black hover:bg-gray-200">
                                        Members
                                    </button>
                                </div>
                            </div>

                            <!-- Pending Users Table -->
                            <div class="bg-[#ececec] border border-[#cdcdcd] relative overflow-x-auto overflow-y-auto max-h-[calc(6*4.5rem)] rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <thead class="text-xs text-black uppercase bg-[#ececec] border-b-2 border-[#e6e6e6]">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">First Name</th>
                                            <th scope="col" class="px-6 py-3">Middle Name</th>
                                            <th scope="col" class="px-6 py-3">Last Name</th>
                                            <th scope="col" class="px-6 py-3">Email</th>
                                            <th scope="col" class="px-6 py-3">Role</th>
                                            <th scope="col" class="px-6 py-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pending_users as $user)
                                        <tr class="user-row bg-[#ececec] border-b hover:bg-[#e6e6e6]" data-role="{{ $user->role }}">
                                            <td class="px-6 py-4 text-gray-900 font-normal">{{ $user->first_name }}</td>
                                            <td class="px-6 py-4 text-gray-900 font-normal">{{ $user->middle_name }}</td>
                                            <td class="px-6 py-4 text-gray-900 font-normal">{{ $user->last_name }}</td>
                                            <td class="px-6 py-4 text-gray-900 font-normal">{{ $user->email }}</td>
                                            <td class="px-6 py-4 text-gray-900 font-normal">{{ $user->role }}</td>
                                            <td class="px-6 py-4">
                                                <div class="flex space-x-2"> 
                                                    <form action="{{ url('admin/accept_user', $user->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-4 py-2 text-center shadow-lg shadow-green-500/30">
                                                            Accept
                                                        </button>
                                                    </form>
                                                    <form action="{{ url('admin/reject_user', $user->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-4 py-2 text-center shadow-lg shadow-red-500/30">
                                                            Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- activity logs -->
                    <div class="lg:col-span-4 bg-[#ececec] border border-[#cdcdcd] rounded-md shadow-xl p-4 mt-4 lg:mt-0">
                        <div class="p-2">
                            <h1 class="underline font-bold text-lg mb-2">.</h1>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <script>
            // success alert function
            setTimeout(function() {
                var success_alert = document.getElementById('success-alert');
                if (success_alert) {
                    success_alert.style.transition = 'opacity 0.5s ease-out';
                    success_alert.style.opacity = '0';
                    setTimeout(function() {
                        success_alert.remove();
                    }, 500); 
                }
            }, 4000); 

            document.addEventListener('DOMContentLoaded', function () {
            const allButton = document.getElementById('filter-all');
            const managersButton = document.getElementById('filter-managers');
            const membersButton = document.getElementById('filter-members');
            const userRows = document.querySelectorAll('.user-row');

            // function to reset all buttons' background
            function resetButtonBackground() {
                allButton.classList.remove('bg-[#ececec]');
                managersButton.classList.remove('bg-[#ececec]');
                membersButton.classList.remove('bg-[#ececec]');
            }

            // default behavior: highlight "All" button and show all rows
            resetButtonBackground();  // reset background for all buttons
            allButton.classList.add('bg-[#ececec]');  // set background for 'All' button
            userRows.forEach(row => row.style.display = 'table-row');

            // show all rows (default) and highlight the "All" button
            allButton.addEventListener('click', function () {
                resetButtonBackground();  // reset background for all buttons
                allButton.classList.add('bg-[#ececec]');  // set background for 'All' button
                userRows.forEach(row => row.style.display = 'table-row');
            });

            // show only "Manager" role rows and highlight the "Managers" button
            managersButton.addEventListener('click', function () {
                resetButtonBackground();  // reset background for all buttons
                managersButton.classList.add('bg-[#ececec]');  // set background for 'Managers' button

                userRows.forEach(row => {
                    if (row.getAttribute('data-role') === 'manager') {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // show only "Member" role rows and highlight the "Members" button
            membersButton.addEventListener('click', function () {
                resetButtonBackground();  // reset background for all buttons
                membersButton.classList.add('bg-[#ececec]');  // set background for 'Members' button

                userRows.forEach(row => {
                    if (row.getAttribute('data-role') === 'member') {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

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
