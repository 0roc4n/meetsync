<!-- Modal -->
<div id="add_meeting_modal" class="font-inter fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50 hidden">
    <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg transform transition-transform duration-300 ease-in-out scale-90 w-full max-w-lg max-h-full mx-4 sm:mx-6 md:mx-8 lg:mx-10 xl:mx-12 2xl:mx-16" id="modalContent">
        <div class="p-8 overflow-y-auto max-h-[calc(100vh-2rem)]"> 
            <h2 class="text-2xl font-semibold mb-5">Set a new meeting.</h2>
            <form method="POST" action="{{ url('/add_meeting') }}">
                @csrf
                <input type="hidden" name="id" value="">
                <div class="mb-4">
                    <label for="meeting_title" class="block text-sm font-semibold text-black">Title</label>
                    <input type="text" id="meeting_title" name="meeting_title" placeholder="Enter meeting's title" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-#f4f4f4 text-black placeholder-#828282-50 focus:outline-none focus:border-#171717 focus:bg-white sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="meeting_location" class="block text-sm font-semibold text-black">Location</label>
                    <input type="text" id="meeting_location" name="meeting_location" placeholder="Enter meeting's location" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-#f4f4f4 text-black placeholder-#828282-50 focus:outline-none focus:border-#171717 focus:bg-white sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="meeting_agenda" class="block text-sm font-semibold text-black">Agenda</label>
                    <input type="text" id="meeting_agenda" name="meeting_agenda" placeholder="Enter meeting's agenda" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-#f4f4f4 text-black placeholder-#828282-50 focus:outline-none focus:border-#171717 focus:bg-white sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="meeting_date" class="block text-sm font-semibold text-black">Date</label>
                    <input type="date" id="meeting_date" name="meeting_date" placeholder="Enter meeting's date" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-#f4f4f4 text-black placeholder-#828282-50 focus:outline-none focus:border-#171717 focus:bg-white sm:text-sm" required>
                </div>
                <div class="mb-6">
                    <label for="meeting_time" class="block text-sm font-semibold text-black">Time</label>
                    <input type="time" id="meeting_time" name="meeting_time" placeholder="Enter meeting's time" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-#f4f4f4 text-black placeholder-#828282-50 focus:outline-none focus:border-#171717 focus:bg-white sm:text-sm" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-black">Invite Members</label>
                    <div class="border border-gray-300 rounded-md p-3 max-h-40 overflow-y-auto bg-#f4f4f4">
                        @foreach(App\Models\Members::where('manager', Auth::guard('manager')->id())->get() as $member)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="member_{{ $member->id }}" name="invited_members[]" value="{{ $member->first_name . ' ' . $member->last_name }}" class="mr-2">
                                <label for="member_{{ $member->id }}" class="text-black text-sm">
                                    {{ $member->first_name }} {{ $member->last_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="text-white bg-red-600 hover:bg-red-600 hover:opacity-90 rounded-lg text-sm px-5 py-2 text-center font-medium mr-2" id="close_modal_btn">Close</button>
                    <button type="submit" class="text-white bg-black hover:bg-black hover:opacity-90 rounded-lg text-sm px-5 py-2 text-center font-medium">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
