<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notes</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/attendance.css') }}">
    <script src="{{ asset('build/assets/attendance.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="sender-name" content="{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}">

</head>

<body class="bg-#e0e0e2">
    @include('manager.header')
    @include('manager.sidebar')
    @include('manager.attendance')

    <div class="px-10 mt-8">
        <h1 class="font-inter text-3xl font-extrabold">Edit Notes</h1>
    </div>

    @if(session('success_message'))
        <div class="px-10 mt-4 mb-5">
            <div id="success-alert" class="bg-green-500 text-white p-4 rounded">
                {{ session('success_message') }}
            </div>
        </div>
    @endif

    <div class="px-10 mt-3 text-end">
        <form action="{{ route('archive_meeting', $meeting_info->id) }}" method="POST" class="inline">
            @csrf
            @method('PUT')
            <button type="submit"
                class="text-white bg-gradient-to-r from-black via-gray-800 to-gray-900 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
                Archive
            </button>
        </form>
    </div>

    <!-- NOTES -->
    <div class="px-10 mt-7 mb-10 font-inter">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            <div class="col-span-1 lg:col-span-4 bg-#ececec border border-#cdcdcd rounded-lg shadow-xl p-7">
                <form action="{{ url('/update_meeting/' . $meeting_info->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- MEETING NAME -->
                    <div>
                        <h2 class="text-xl font-bold">{{ $meeting_info->title }}</h2>
                    </div>
                    <!-- MEETING AGENDA -->
                    <div class="mt-4 ml-2 flex items-center">
                        <img src="{{ asset('images/agenda.svg') }}" alt="Image Description" class="w-5 h-5">
                        <span class="ml-2 text-sm text-#484848">{{ $meeting_info->agenda }}</span>
                    </div>
                    <!-- MEETING LOCATION -->
                    <div class="mt-4 ml-2 flex items-center">
                        <img src="{{ asset('images/location.svg') }}" alt="Image Description" class="w-5 h-5">
                        <span class="ml-2 text-sm text-#484848">{{ $meeting_info->location }}</span>
                    </div>
                    <!-- MEETING DATE AND TIME -->
                    <div class="mt-2 ml-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{ asset('images/calendar.svg') }}" alt="Image Description" class="w-5 h-5">
                            @php
                                $date = new DateTime($meeting_info->date);
                                $date_new_format = $date->format('F d, Y');

                                $time = new DateTime($meeting_info->time);
                                $time_new_format = $time->format('h:i A');
                            @endphp
                            <span class="ml-2 text-sm text-#484848">{{ $date_new_format }} -
                                {{ $time_new_format }}</span>
                        </div>

                        <!-- START RECORDING BUTTON -->
                        <div>
                            <button type="button" id="start-recording"
                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
                                Start Recording
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <!-- MEETING SUMMARY -->
                        <div class="mt-4 w-1/2 mx-2">
                            <textarea readonly id="summary" name="summary"
                                class="w-full p-2 border border-gray-300 rounded-lg" rows="30"
                                style="max-height: 80vh; overflow: auto"></textarea>
                        </div>

                        <!-- MEETING NOTES -->
                        <div class="mt-4 w-1/2 mx-2">
                            <textarea id="note" name="notes" class="w-full p-2 border border-gray-300 rounded-lg"
                                rows="30" style="max-height: 80vh; overflow: auto">{{ $meeting_info->notes }}</textarea>
                        </div>
                    </div>
                    <!-- MEETING ACTION BUTTONS -->
                    <div class="mt-3 flex items-center justify-end space-x-3">
                        <!-- CONVERT TO PDF BUTTON -->
                        <div>
                            <a href="{{ route('convert_to_pdf_manager', $meeting_info->id) }}" class="inline-block">
                                <img src="{{ asset('images/pdf.png') }}" alt="Convert to PDF"
                                    class="h-14 px-1 py-2 rounded-lg transition-all duration-200 ease-in-out transform hover:scale-105 hover:opacity-80">
                            </a>
                        </div>

                        <!-- SAVE CHANGES BUTTON -->
                        <div>
                            <button type="submit"
                                class="text-white bg-gradient-to-r from-black via-gray-800 to-gray-900 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>



            <!-- ATTENDANCE -->
            <div class="col-span-1 flex flex-col h-full">
                <div class="bg-[#ececec] border border-[#cdcdcd] rounded-lg shadow-xl p-7 flex-grow flex flex-col">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-bold underline">Attendance</h3>
                        <button id="attendance_button" class="rounded-full focus:outline-none">
                            <img src="{{ asset('images/addbutton.svg') }}" alt="Add Attendance"
                                class="w-7 h-7 transition-all duration-300 ease-in-out hover:scale-125">
                        </button>
                    </div>
                    <ul class="mt-3 flex-grow">
                        @forelse($attendees as $attendee)
                            <li class="py-1">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium"><a class="mr-2.5">-</a>
                                        {{ $attendee->member_name }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="py-2">
                                <span class="text-sm text-gray-600">No attendance record yet.</span>
                            </li>
                        @endforelse
                    </ul>
                </div>

                <!-- spaceeee -->
                <div class="h-4"></div>

                <!-- APPROVED MEMBERS -->
                <div class="bg-[#ececec] border border-[#cdcdcd] rounded-lg shadow-xl p-7 flex-grow flex flex-col">
                    <h3 class="text-xl font-bold underline mb-4">Approved by:</h3>
                    <div class="flex-grow">
                        @foreach($approved_members as $member)
                            <div class="py-1.5 flex">
                                <img src="{{ asset('images/approvecheck.svg') }}" alt="Approved" class="w-6 h-6 mr-2">
                                <span class="text-sm font-medium">{{ $member->first_name }} {{ $member->last_name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script>
        function isQuestion(sentence) {
            const questionWords = [
                // English
                "who", "what", "where", "when", "why", "how", "do", "does", "did", "can", "could", "should", "would", "is", "are", "was", "were", "will",

                // Tagalog
                "sino", "ano", "saan", "kailan", "bakit", "paano", "pwede", "maaari", "magkano", "ilan", "gaano",

                // Bicol
                "sisay", "ano", "hain", "nuarin", "tanu", "pauno", "puede", "magkano", "pira", "gurano"
            ];

            const words = sentence.toLowerCase().split(" ");
            return questionWords.includes(words[0]);
        }

        // Connect to the Socket.IO server
        const socket = io('https://meetsync-socket-io.onrender.com')
        // Join a room specific to the meeting and manager
        const noteId = {{ $meeting_info->id }}; // Meeting ID
        const managerId = {{ $meeting_info->manager_id }}; // Manager ID
        socket.emit('join', { role: 'member', meetingId: noteId, managerId });
        const senderName = document.querySelector('meta[name="sender-name"]').getAttribute('content');

        // Send note updates when the member modifies the textarea
        const notetext_area = document.querySelector('textarea[name="notes"]');
        const conversationTextArea = document.querySelector('textarea[name="summary"]')
        notetext_area.addEventListener('input', function () {
            const note_content = notetext_area.value;
            socket.emit('update_note', { meetingId: noteId, managerId, content: note_content });
        });

        // Receive and apply note updates in real-time
        socket.on('note_updated', function (updated_note) {
            console.log(updated_note)
            notetext_area.value = updated_note;
        });


        // Receive and apply conversation updates in real-time
        socket.on('conversation_updated', function (convo) {
            conversationTextArea.value = convo;
        });



        // speech-to-Text functionality for start/stop recording button
        const startRecordingBtn = document.getElementById('start-recording');
        const noteTextArea = document.getElementById('note');
        let recognition;
        let isRecording = false; // track recording state
        let transcriptionBuffer = ''; // store the ongoing transcription

        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.continuous = true;
            recognition.interimResults = true;

            // handle button clicks for start/stop
            startRecordingBtn.addEventListener('click', () => {
                if (!isRecording) {
                    recognition.start(); // start speech recognition
                    isRecording = true;
                    transcriptionBuffer = conversationTextArea.value + " "; // preserve existing text
                    startRecordingBtn.textContent = 'Stop Recording'; // update button text
                } else {
                    recognition.stop(); // stop speech recognition
                    isRecording = false;
                    startRecordingBtn.textContent = 'Start Recording'; // update button text
                }
            });

            // triggering spacebar for start/stop recording
            document.addEventListener('keydown', function (event) {
                // check if spacebar (key code 32) is pressed and no input/textarea is focused
                if (event.code === 'Space' && document.activeElement.tagName !== 'TEXTAREA' && document.activeElement.tagName !== 'INPUT') {
                    event.preventDefault();  // prevent default scrolling behavior
                    startRecordingBtn.click();  // trigger the button click
                }
            });

            recognition.onresult = function (event) {
                let interimTranscript = '';
                let finalTranscript = '';

                for (let i = event.resultIndex; i < event.results.length; i++) {
                    if (event.results[i].isFinal) {
                        finalTranscript += event.results[i][0].transcript; // Store final recognized text
                    } else {
                        interimTranscript += event.results[i][0].transcript; // Store interim text
                    }
                }

                if (finalTranscript) {
                    let isQuestionText = isQuestion(finalTranscript) ? '?' : '.';
                    // Append final text with proper spacing
                    transcriptionBuffer += `\n${senderName}: ${finalTranscript}${isQuestionText}`;
                }

                const convo = transcriptionBuffer + (interimTranscript ? '\n' + interimTranscript : '');
                conversationTextArea.value = convo;



                if (finalTranscript.trim().length > 0) {
                    fetch('{{ route('save_message') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Correct CSRF retrieval
                        },
                        body: JSON.stringify({
                            meetingId: noteId,
                            managerId: managerId,
                            senderName,
                            content: finalTranscript + (isQuestion(finalTranscript) ? '?' : '.')
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Message saved:', data);
                        })
                        .catch(error => {
                            console.error('Error saving message:', error);
                        });
                }

                // Emit to WebSocket for real-time updates
                socket.emit('from_client_convo_update', { meetingId: noteId, managerId, content: convo });
            };


            recognition.onerror = function (event) {
                console.error('Speech recognition error: ', event.error);
                alert('An error occurred with the speech recognition: ' + event.error);
            };

            recognition.onend = function () {
                isRecording = false; // ensure recording state is reset when recognition stops
                startRecordingBtn.textContent = 'Start Recording'; // reset button text
            };
        } else {
            alert('Your browser does not support speech recognition.');
        }




        function fetchMessages() {
            fetch('{{ route('fetch.messages') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ meetingId: noteId })
            })
                .then(response => response.json())
                .then(messages => {
                    let formattedMessages = messages.map(msg => {
                        return `${msg.sender_name}: ${msg.content}`
                    }).join('\n');
                    document.querySelector('textarea[name="summary"]').value = formattedMessages;
                })
                .catch(error => console.error('Error fetching messages:', error));
        }

        // Call fetchMessages() when the page loads
        window.onload = fetchMessages;

    </script>

</body>

</html>