<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log In</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    </head>
    <body>
        <!-- component -->
        <div class="flex min-h-screen overflow-y-auto">
            <!-- Left -->
            <div class="w-full bg-#e0e0e2 font-inter lg:w-1/2 flex items-center justify-center">
                <div class="max-w-md w-full p-5 lg:p-0 animate-fade_in">
                    @if(session('error'))
                        <div id="error-alert" class="p-4 mb-4 border border-red-400 text-sm text-red-700 rounded relative bg-red-100" role="alert">
                            <strong>Oops!</strong> {{ session('error') }}
                        </div>
                    @endif

                    <script>
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

                    <!-- Tabs -->
                    <div class="flex justify-center mb-6 border-b border-gray-300">
                        <a href="{{ url('/manager_sign_up_form') }}" class="px-4 py-2 text-sm font-medium text-center {{ request()->is('manager_sign_up') ? 'text-black border-b-2 border-black' : 'text-black-500 font-semibold border-b-2 border-black' }}">
                            Manager Sign Up
                        </a>
                        <a href="{{ url('/member_sign_up_form') }}" class="px-4 py-2 text-sm font-medium text-center {{ request()->is('member_sign_up') ? 'text-black border-b-2 border-black' : 'text-gray-500' }}">
                            Member Sign Up
                        </a>
                    </div>
                    
                    <h1 class="text-3xl font-bold mb-1 text-black">Get started now</h1>
                    <h1 class="text-l font-semibold mb-6 text-black-500">Create a new account as a manager.</h1>
                    
                    <form action="{{ url('/manager_sign_up_process') }}" method="POST" class="space-y-3">
                    @csrf
                        <div class="flex flex-col lg:flex-row items-center justify-between">
                            <div class="w-full lg:w-1/2 mb-2 lg:mb-0">
                                <div>
                                    <label for="first_name" class="block text-sm font-semibold text-black">First Name</label>
                                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-#171717 sm:text-sm placeholder-#828282-50 bg-#f4f4f4">
                                </div>
                            </div>
                            <div class="w-full lg:w-1/2 ml-0 lg:ml-2">
                                <div>
                                    <label for="middle_name" class="block text-sm font-semibold text-black">Middle Name</label>
                                    <input type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-#171717 sm:text-sm placeholder-#828282-50 bg-#f4f4f4">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col lg:flex-row items-center justify-between">
                            <div class="w-full lg:w-1/3 mb-2 lg:mb-0">
                                <div>
                                    <label for="last_name" class="block text-sm font-semibold text-black">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-#171717 sm:text-sm placeholder-#828282-50 bg-#f4f4f4">
                                </div>
                            </div>
                            <div class="w-full lg:w-2/3 ml-0 lg:ml-2">
                                <div>
                                    <label for="organizations_name" class="block text-sm font-semibold text-black">Organization Name</label>
                                    <input type="text" id="organizations_name" name="organizations_name" placeholder="Enter your organization's name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-#171717 sm:text-sm placeholder-#828282-50 bg-#f4f4f4">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row items-center justify-between">
                            <div class="w-full lg:w-full mb-2 lg:mb-0">
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-black">Email Address</label>
                                    <input type="email" id="email" name="email" placeholder="Enter your email address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-#171717 sm:text-sm placeholder-#828282-50 bg-#f4f4f4">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col lg:flex-row items-center justify-between">
                            <div class="w-full lg:w-1/2 mb-2 lg:mb-0">
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-black">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Enter your password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-#171717 sm:text-sm placeholder-#828282-50 bg-#f4f4f4">
                                </div>
                            </div>
                            <div class="w-full lg:w-1/2 ml-0 lg:ml-2">
                                <div>
                                    <label for="confirm_password" class="block text-sm font-semibold text-black">Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-#171717 sm:text-sm placeholder-#828282-50 bg-#f4f4f4">
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="mt-4 w-full bg-#171717 hover:bg-#2C2C2C text-white text-base font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-150">
                                Sign Up
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 text-sm text-gray-500 text-center">
                        <p>Already have an account? <a href="{{ url('/') }}" class="text-black underline">Log in!</a>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Right -->
            <div class="hidden lg:flex items-center justify-center flex-1 bg-white text-black">
                <div class="w-full h-full">
                    <img src="{{ asset('images/cover.jpg') }}" alt="Cover Image" class="w-full h-screen object-cover">
                </div>
            </div>
        </div>

    </body>
</html>