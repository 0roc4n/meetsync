<!-- Attendance modal -->
<div id="attendance_modal" class="font-inter fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50 hidden">
    <div class="bg-gray-200 rounded-lg overflow-hidden shadow-lg transform transition-transform duration-300 ease-in-out scale-90 w-full max-w-lg max-h-full mx-4 sm:mx-6 md:mx-8 lg:mx-10 xl:mx-12 2xl:mx-16" id="modalContent">
        <div class="p-8 overflow-y-auto max-h-[calc(100vh-2rem)]"> 
            <h2 class="text-2xl font-semibold mb-1">For attendance.</h2>
            <h3 class="text-black opacity-70 text-sm font-normal mb-5">Check the checkboxes of the members who are present for this meeting.</h3>
            <form method="POST" action="{{ route('meetings.attendance.store', ['meeting_id' => $meeting_info->id]) }}">
                @csrf
                @foreach($members_to_display as $member)
                    <div class="py-2">
                        <div class="flex items-center space-x-3">
                            <!-- checkbox: only show if the member hasn't attended yet -->
                            <input type="checkbox" name="attendees[]" value="{{ $member->id }}">
                            <div class="w-11 h-11 rounded-full bg-gray-500 flex justify-center">
                                <img src="{{ asset($member->profile_picture) }}" alt="{{ $member->first_name }} {{ $member->last_name }}'s Profile Picture" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="flex flex-col items-start font-inter">
                                <span class="text-sm font-semibold">{{ $member->first_name }} {{ $member->last_name }}</span>
                                <span class="text-sm text-gray-600">{{ $member->email }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-end">
                    <button type="button" class="text-white bg-red-600 hover:bg-red-600 hover:opacity-90 rounded-lg text-sm px-5 py-2 text-center font-medium mr-2" id="close_modal_btn">Close</button>
                    <button type="submit" class="text-white bg-black hover:bg-black hover:opacity-90 rounded-lg text-sm px-5 py-2 text-center font-medium">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 
