<!-- Sidebar -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-60 z-40 hidden"></div>
<div id="sidebar" class="fixed inset-y-0 left-0 bg-#171717 w-64 transform -translate-x-full transition-transform duration-500 ease-in-out z-50">
    <div class="h-full p-5 flex flex-col">

        <!-- Top Bar with MS Logo, MEETSYNC, and Close Button -->
        <div class="flex flex-col">
            <div class="flex items-center justify-between mb-2 mt-4">
                <div class="flex items-center space-x-2">
                    <!-- MS Logo -->
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-8">
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
                    <a href="/home" class="flex items-center px-3 py-3 hover:bg-#333333-90 hover:rounded-md hover:cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="2" class="w-6 h-5 mr-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 20.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <span class="text-#9E9E9E font-semibold group-hover:text-white group-hover:font-bold text-sm">Home</span>
                    </a>

                    <a href="/meetings" class="flex items-center px-3 py-3 hover:bg-#333333-90 hover:rounded-md hover:cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-5 mr-5">
                            <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625ZM21 9.375A.375.375 0 0 0 20.625 9h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5ZM10.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5ZM3.375 15h7.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h7.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 10.875 9h-7.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-#9E9E9E font-semibold group-hover:text-white group-hover:font-bold text-sm">Meetings</span>
                    </a>
                    
                    <a href="/members" class="flex items-center px-3 py-3 hover:bg-#333333-90 hover:rounded-md hover:cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-5 mr-5">
                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                        </svg>
                        <span class="text-#9E9E9E font-semibold group-hover:text-white group-hover:font-bold text-sm">Members</span>
                    </a>

                    <a href="/account_settings" class="flex items-center px-3 py-3 hover:bg-#333333-90 hover:rounded-md hover:cursor-pointer group">
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
        <div class="bg-[#33333340] p-3 text-white mt-auto rounded-md mb-2 max-h-[80px] overflow-hidden">
            <div class="flex items-start gap-2 w-full">
                <!-- Profile Circle -->
                @isset($info)
                    <div class="flex-shrink-0 w-20 h-20">
                        <img src="{{ asset($info->profile_picture) }}" alt="Profile Picture" class="w-8 h-18 object-cover rounded-full ring-1 ring-gray-400">
                    </div>
                @endisset
                <!-- Text Column -->
                <div class="flex-1 min-w-0 max-w-[160px]">
                    @isset($info)
                        <p class="text-sm font-medium truncate text-white">{{ $info->first_name }} {{ $info->last_name }}</p>
                        <p class="text-[11px] text-gray-300 truncate">{{ $info->email }}</p>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
