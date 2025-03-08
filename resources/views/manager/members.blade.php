<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Members</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    </head>
    <body class="bg-#e0e0e2 animate-fade_in">
        @include('manager.header')
        @include('manager.sidebar')
        <div class="pb-16 animate-fade_in"> 
            
            <div class="px-10 mt-8">
                <h1 class="font-inter text-3xl font-extrabold"> Members </h1>
            </div>
            
            <div class="flex flex-wrap px-10 mt-7 font-inter">
                <div class="w-full mb-4">

                    @if(session('success'))
                        <div id="success-alert" class="bg-green-500 text-sm text-white p-4 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div id="error-alert" class="bg-red-500 text-sm text-white p-4 mb-4 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex w-full justify-end mt-8 sm:mt-0 sm:w-auto sm:ml-4 mb-3 font-inter">
                        <form action="{{ url('/add_member') }}" method="POST" class="flex w-full max-w-md"> <!-- Added w-full and max-w-xl to the form -->
                            @csrf
                            <div class="relative flex-1 mr-2">
                                <input type="search" name="email" id="search-dropdown" class="shadow-sm block p-2 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-300 focus:outline-none focus:border-gray-300" placeholder="Enter email address" required />
                            </div>
                            <button id="add_member_btn" type="submit" class="mb-2 text-white bg-gradient-to-r from-black via-gray-800 to-gray-900 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
                                Add
                            </button>
                        </form>
                    </div>


                    <div class="bg-[#ececec] border border-[#cdcdcd] relative overflow-x-auto shadow-xl rounded-lg">
                        <table class="w-full text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-black uppercase bg-[#ececec] border-b-2 border-[#e6e6e6]">
                                <tr>
                                    <th scope="col" class="px-6 py-3"> Name </th>
                                    <th scope="col" class="px-6 py-3"> Email </th>
                                    <th scope="col" class="px-6 py-3"> Role </th>
                                    <th scope="col" class="px-6 py-3"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                <tr class="bg-[#ececec] border-b hover:bg-[#e6e6e6]">
                                    <th scope="row" class="flex items-center px-6 py-5 text-gray-900 whitespace-nowrap">
                                        <img class="w-11 h-11 rounded-full" src="{{ asset($member->profile_picture) }}" alt="{{ $member->first_name }} image">
                                        <div class="ps-3">
                                            <div class="text-base text-[#262626] font-semibold">
                                                {{ $member->first_name . ' ' . $member->middle_name}}
                                            </div>
                                            <div class="text-base text-[#262626] font-semibold">{{$member->last_name}}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4 text-[#262626] text-sm ">{{ $member->email }}</td>
                                    <td class="px-6 py-4 text-[#262626] text-sm ">
                                        <div class="flex items-center">
                                            {{ $member->role }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($member->role === 'manager')
                                            <span class="text-gray-500">Cannot be removed</span>
                                        @else
                                            <form action="{{ route('remove.member', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member?');">
                                                @csrf
                                                <button type="submit" class="font-medium text-red-600 text-sm hover:underline">
                                                    Remove
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


        <script>
            // success alert function
            setTimeout(function() {
                    var success_alert = document.getElementById('success-alert');
                if (success_alert) {
                    success_alert.style.transition = 'opacity 0.6s ease-out';
                    success_alert.style.opacity = '0';
                    setTimeout(function() {
                        success_alert.remove();
                    }, 500); 
                }
            }, 4000); 

            // error alert function
            setTimeout(function() {
                var error_alert = document.getElementById('error-alert');
                if (error_alert) {
                    error_alert.style.transition = 'opacity 0.6s ease-out';
                    error_alert.style.opacity = '0';
                    setTimeout(function() {
                        error_alert.remove();
                    }, 500); 
                }
            }, 4000); 
        </script>     


    </body>
</html>
