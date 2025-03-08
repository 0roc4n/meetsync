<!-- Sidebar -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-60 z-40 hidden"></div>
<div id="sidebar" class="fixed inset-y-0 left-0 bg-#171717 w-64 transform -translate-x-full transition-transform duration-500 ease-in-out z-50">
    <div class="h-full p-5 flex flex-col">

        <!-- Top Bar with Heart Icon, MEETSYNC, and Close Button -->
        <div class="flex flex-col">
            <div class="flex items-center justify-between mb-2 mt-4">
                <div class="flex items-center space-x-2">
                    <!-- Heart Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#BFB2FF" viewBox="0 0 24 24" class="w-6 h-6 text-red-500">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    <!-- MEETSYNC Word -->
                    <span class="text-white font-bold text-xl font-inter">MEETSYNC</span>
                </div>
                <!-- Close Button -->
                <button id="close-button" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Yellow Line -->
            <div class="mt-5 mb-5 border-b-2 border-#333333-90"></div>
        </div>

        <!-- Menu Text -->
        <div class="font-inter text-white text-xxs mt-3 mb-4 ml-3 underline">MENU</div>
        
        <!-- Sidebar Content -->
        <nav class="font-inter">
            <ul class="flex flex-col">
                <li>
                    <a href="/dashboarda" class="flex items-center px-3 py-3 hover:bg-#333333-90 hover:rounded-md hover:cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="2" class="w-6 h-5 mr-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <span class="text-#9E9E9E font-semibold group-hover:text-white group-hover:font-bold text-sm">Dashboard</span>
                    </a>

                    <a href="/organizations" class="flex items-center px-3 py-3 hover:bg-#333333-90 hover:rounded-md hover:cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="2" class="w-6 h-5 mr-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>          
                        <span class="text-#9E9E9E font-semibold group-hover:text-white group-hover:font-bold text-sm">Organizations</span>
                    </a>

                    <a href="/account_settingsa" class="flex items-center px-3 py-3 hover:bg-#333333-90 hover:rounded-md hover:cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-5 mr-5">
                            <path fill-rule="evenodd" d="M11.828 2.25c-.916 0-1.699.663-1.85 1.567l-.091.549a.798.798 0 0 1-.517.608 7.45 7.45 0 0 0-.478.198.798.798 0 0 1-.796-.064l-.453-.324a1.875 1.875 0 0 0-2.416.2l-.243.243a1.875 1.875 0 0 0-.2 2.416l.324.453a.798.798 0 0 1 .064.796 7.448 7.448 0 0 0-.198.478.798.798 0 0 1-.608.517l-.55.092a1.875 1.875 0 0 0-1.566 1.849v.344c0 .916.663 1.699 1.567 1.85l.549.091c.281.047.508.25.608.517.06.162.127.321.198.478a.798.798 0 0 1-.064.796l-.324.453a1.875 1.875 0 0 0 .2 2.416l.243.243c.648.648 1.67.733 2.416.2l.453-.324a.798.798 0 0 1 .796-.064c.157.071.316.137.478.198.267.1.47.327.517.608l.092.55c.15.903.932 1.566 1.849 1.566h.344c.916 0 1.699-.663 1.85-1.567l.091-.549a.798.798 0 0 1 .517-.608 7.52 7.52 0 0 0 .478-.198.798.798 0 0 1 .796.064l.453.324a1.875 1.875 0 0 0 2.416-.2l.243-.243c.648-.648.733-1.67.2-2.416l-.324-.453a.798.798 0 0 1-.064-.796c.071-.157.137-.316.198-.478.1-.267.327-.47.608-.517l.55-.091a1.875 1.875 0 0 0 1.566-1.85v-.344c0-.916-.663-1.699-1.567-1.85l-.549-.091a.798.798 0 0 1-.608-.517 7.507 7.507 0 0 0-.198-.478.798.798 0 0 1 .064-.796l.324-.453a1.875 1.875 0 0 0-.2-2.416l-.243-.243a1.875 1.875 0 0 0-2.416-.2l-.453.324a.798.798 0 0 1-.796.064 7.462 7.462 0 0 0-.478-.198.798.798 0 0 1-.517-.608l-.091-.55a1.875 1.875 0 0 0-1.85-1.566h-.344ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-#9E9E9E font-semibold group-hover:text-white group-hover:font-bold text-sm">Account Settings</span>
                    </a>

                    <a href="{{ url('/logout') }}" class="flex items-center px-3 py-3 hover:bg-#333333-90 hover:rounded-md hover:cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-5 mr-5">
                            <path fill-rule="evenodd" d="M15.75 2.25H21a.75.75 0 0 1 .75.75v5.25a.75.75 0 0 1-1.5 0V4.81L8.03 17.03a.75.75 0 0 1-1.06-1.06L19.19 3.75h-3.44a.75.75 0 0 1 0-1.5Zm-10.5 4.5a1.5 1.5 0 0 0-1.5 1.5v10.5a1.5 1.5 0 0 0 1.5 1.5h10.5a1.5 1.5 0 0 0 1.5-1.5V10.5a.75.75 0 0 1 1.5 0v8.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V8.25a3 3 0 0 1 3-3h8.25a.75.75 0 0 1 0 1.5H5.25Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-#9E9E9E font-semibold group-hover:text-white group-hover:font-bold text-sm">Logout</span>
                    </a>        

                </li>
            </ul>
        </nav>

        <!-- User's Info -->
        <div class="bg-[#33333340] p-5 text-white text-center mt-auto rounded-md">
            <div class="flex">
                <!-- Profile Circle -->
                @isset($info)
                    <div class="w-11 h-11 rounded-full bg-gray-500 flex justify-center mr-3">
                        <img src="{{ asset($info->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover rounded-full">
                    </div>
                @endisset
                <!-- Text Column -->
                <div class="flex flex-col items-start font-inter">
                    @isset($info)
                        <span class="text-sm font-semibold">{{ $info->first_name }} {{ $info->last_name }}</span>
                        <span class="text-xs font-light">{{ $info->email }}</span>
                    @endisset
                </div>
            </div>
        </div>

    </div>
</div>
