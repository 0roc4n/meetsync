<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
</head>
<body class="bg-[#e0e0e2]">
    @include('manager.header')
    @include('manager.sidebar')

    <div class="pb-16 animate-fade_in">
        <div class="px-10 mt-8">
            <h1 class="font-inter text-3xl font-extrabold">Account Settings</h1>

            @if(session('success'))
            <div id="success-alert" class="bg-green-500 text-sm text-white p-4 mb-4 mt-4 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
                <div id="error-alert" class="bg-red-500 text-sm text-white p-4 mb-4 mt-4 rounded">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="flex flex-wrap justify-center px-10 mt-7 font-inter">
            <div class="w-full lg:w-1/2 lg:pr-2 mb-4 lg:mb-0 flex flex-col">
                <div class="bg-[#ececec] border border-[#cdcdcd] rounded-lg shadow-xl min-h-screen p-4 flex-1">
                    <div class="p-8">
                        @isset($info)
                            <div class="flex items-center mt-2 mb-8">
                                <img src="{{ asset($info->profile_picture) }}" alt="Profile Picture" class="w-40 h-40 border-2 border-gray-300 mr-4">
                            </div>
                            <div>
                                <input type="hidden" name="info_id" value="{{ $info->id }}">
                            </div>
                            <div>
                                <p class="text-black text-xs font-normal">FIRST NAME:</p>
                                <p class="text-black text-lg font-semibold" id="user_first_name">{{ $info->first_name }}</p>
                            </div>
                            <div class="mt-4">
                                <p class="text-black text-xs font-normal">MIDDLE NAME:</p>
                                <p class="text-black text-lg font-semibold" id="user_middle_name">{{ $info->middle_name }}</p>
                            </div>
                            <div class="mt-4">
                                <p class="text-black text-xs font-normal">LAST NAME:</p>
                                <p class="text-black text-lg font-semibold" id="user_last_name">{{ $info->last_name }}</p>
                            </div>
                            <div class="mt-4">
                                <p class="text-black text-xs font-normal">ORGANIZATION'S NAME:</p>
                                <p class="text-black text-lg font-semibold" id="user_org_name">{{ $info->organizations_name }}</p>
                            </div>
                            <div class="mt-4">
                                <p class="text-black text-xs font-normal">EMAIL ADDRESS:</p>
                                <p class="text-black text-lg font-semibold" id="user_email">{{ $info->email }}</p>
                            </div>
                            <div>
                                <input type="hidden" name="password_" value="{{ $info->password }}">
                            </div>
                            <div class="mt-4">
                                <p class="text-black text-xs font-normal">ROLE:</p>
                                <p class="text-black text-lg font-semibold" id="user_role">{{ $info->role }}</p>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>

            <!-- FORM -->
            <div class="w-full lg:w-1/2 lg:pl-2 flex flex-col">
                <div class="bg-[#ececec] border border-[#cdcdcd] rounded-lg shadow-xl min-h-screen p-4 flex-1">
                    <div class="p-8">
                        <h2 class="text-2xl font-semibold mb-4">Edit your information.</h2>
                        <hr class="border-t-1.5 border-gray-300 mb-6">
                        <form action="{{ url('/update_manager_account_settings') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-wrap -mx-2">
                                <div class="w-full sm:w-1/2 px-2 mb-4 sm:mb-0">
                                    <label for="firstname" class="block text-sm font-semibold text-black">First Name:</label>
                                    <input type="text" id="firstname" name="firstname_" value="{{ old('firstname_', $info->first_name) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#171717] sm:text-sm placeholder-[#828282]-50 bg-[#f4f4f4]">
                                </div>
                                <div class="w-full sm:w-1/2 px-2">
                                    <label for="middlename" class="block text-sm font-semibold text-black">Middle Name:</label>
                                    <input type="text" id="lastname" name="middlename_" value="{{ old('middlename_', $info->middle_name) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#171717] sm:text-sm placeholder-[#828282]-50 bg-[#f4f4f4]">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-2 mt-6">
                                <div class="w-full sm:w-2/5 px-2 mb-4 sm:mb-0">
                                    <label for="lastname" class="block text-sm font-semibold text-black">Last Name:</label>
                                    <input type="text" id="lastname" name="lastname_" value="{{ old('lastname_', $info->last_name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#171717] sm:text-sm placeholder-[#828282]-50 bg-[#f4f4f4]">
                                </div>
                                <div class="w-full sm:w-3/5 px-2">
                                    <label for="organizationsname" class="block text-sm font-semibold text-black">Organization's Name:</label>
                                    <input type="text" id="organizationsname" name="organizationsname_" value="{{ old('organizationsname_', $info->organizations_name) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#171717] sm:text-sm placeholder-[#828282]-50 bg-[#f4f4f4]">
                                </div>
                            </div>
                            <div class="mt-6">
                                <label for="email" class="block text-sm font-semibold text-black">Email Address:</label>
                                <input type="text" id="email" name="email_" value="{{ old('email_', $info->email) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#171717] sm:text-sm placeholder-[#828282]-50 bg-[#f4f4f4]">
                            </div>
                            <div class="mt-6">
                                <label for="password" class="block text-sm font-semibold text-black">Password</label>
                                <input type="password" id="password" name="password_" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#171717] sm:text-sm placeholder-[#828282]-50 bg-[#f4f4f4]">
                            </div>
                            <div class="mt-6">
                                <label for="profile_picture" class="block text-sm font-semibold text-black">Upload Image:</label>
                                <input type="file" id="profilepicture" name="profilepicture_" accept="image/*" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#171717] sm:text-sm bg-[#f4f4f4] cursor-pointer">
                            </div>

                            <div class="mt-5 flex w-full justify-end">
                                <button id="update_btn" type="submit" class="text-white bg-gradient-to-r from-black via-gray-800 to-gray-900 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
                                    Update
                                </button>
                            </div>
                        </form>
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

        // error alert function
        setTimeout(function() {
            var error_alert = document.getElementById('error-alert');
            if (error_alert) {
                error_alert.style.transition = 'opacity 0.5s ease-out';
                error_alert.style.opacity = '0';
                setTimeout(function() {
                    error_alert.remove();
                }, 500); 
            }
        }, 4000);
    </script> 
    <!--<script>
        document.getElementById('add_meeting_btn').addEventListener('click', function() {
            document.getElementById('firstname').value = document.getElementById('user_first_name').innerText;
            document.getElementById('lastname').value = document.getElementById('user_last_name').innerText;
            document.getElementById('organizationsname').value = document.getElementById('user_org_name').innerText;
            document.getElementById('email').value = document.getElementById('user_email').innerText;
        });
    </script>-->
</body>
</html>
