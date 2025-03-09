<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notes</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <script src="https://translation.googleapis.com/language/translate/v2?key=YOUR_ACTUAL_API_KEY"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="sender-name" content="{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}">
</head>

<body class="bg-#e0e0e2">
    @include('member.header')
    @include('member.sidebar')
    <div class="px-10 mt-8">
        <h1 class="font-inter text-3xl font-extrabold">Edit Notes</h1>
    </div>
    <!-- APPROVING NOTES -->
    <div class="mt-3 text-end mr-10">
        <form action="{{ url('/meetings/' . $meeting_info->id . '/approve') }}" method="POST">
            @csrf
            <button type="submit" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg 
                    text-sm px-5 py-2 text-center">
                Approve Notes
            </button>
        </form>
    </div>
    @if(session('error_message'))
        <div class="alert alert-danger">
            {{ session('error_message') }}
        </div>
    @endif
    <div class="px-10 mt-5 mb-10 font-inter">
        <div class="bg-#ececec border border-#cdcdcd rounded-lg shadow-xl p-7">
            <form action="{{ url('/update_meeting_member/' . $meeting_info->id) }}" method="POST">
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
                        <span class="ml-2 text-sm text-#484848">{{ $date_new_format }} - {{ $time_new_format }}</span>
                    </div>

                    <!-- START RECORDING BUTTON -->
                    <div>
                        <!--<form action="" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')-->
                        <button type="button" id="start-recording"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
                            Start Recording
                        </button>
                        <!--</form>-->
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <!-- MEETING SUMMARY -->
                    <div class="mt-4 w-1/2 mx-2">
                        <textarea readonly id="summary" name="summary"
                            class="w-full p-2 border border-gray-300 rounded-lg" rows="30"
                            
                            style="max-height: 80vh; overflow: auto">{{ $meeting_info->summary }}
                        </textarea>
                    </div>

                    <!-- MEETING NOTES -->
                    <div class="mt-4 w-1/2 mx-2">
                        <textarea id="note" name="notes" class="w-full p-2 border border-gray-300 rounded-lg" rows="30"
                            style="max-height: 80vh; overflow: auto">{{ $meeting_info->notes }}</textarea>
                    </div>
                </div>

                <!-- MEETING ACTION BUTTONS -->
                <div class="mt-3 flex items-center justify-end space-x-3">
                    <!-- CONVERT TO PDF BUTTON -->
                    <div>
                        <a href="{{ route('convert_to_pdf_member', $meeting_info->id) }}" class="inline-block">
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
        <!-- hidden input to store unique note ID for each note -->
        <input type="hidden" id="noteId" value="{{ $meeting_info->id }}">
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
        const socket = io('http://localhost:3001'); // Changed from 3000 to 3001

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

        // Add socket listener for summary updates
        socket.on('summary_updated', function(updated_summary) {
            conversationTextArea.value = updated_summary;
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
                    
                    // First update the display with untranslated text
                    const tempConvo = transcriptionBuffer + `\n${senderName}: ${finalTranscript}${isQuestionText}` + 
                        (interimTranscript ? '\n' + interimTranscript : '');
                    conversationTextArea.value = tempConvo;

                    // Then translate and update
                    fetch('{{ route('translate') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ text: finalTranscript })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const translatedText = data.translatedText;
                        transcriptionBuffer += `\n${senderName}: ${translatedText}${isQuestionText}`;
                        const convo = transcriptionBuffer + (interimTranscript ? '\n' + interimTranscript : '');
                        conversationTextArea.value = convo;
                        
                        // Emit translated conversation
                        socket.emit('from_client_convo_update', { 
                            meetingId: noteId, 
                            managerId, 
                            content: convo 
                        });

                        // Save translated message
                        fetch('{{ route('save_message') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                meetingId: noteId,
                                managerId: managerId,
                                senderName,
                                content: translatedText + (isQuestion(translatedText) ? '?' : '.')
                            })
                        });
                    });
                }

                const convo = transcriptionBuffer + (interimTranscript ? '\n' + interimTranscript : '');
                conversationTextArea.value = convo;

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

        // Add translation functionality
        const translateText = async (text) => {
            try {
                const response = await fetch('{{ route('translate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        text: text
                    })
                });
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                const data = await response.json();
                return data.translatedText || text;
            } catch (error) {
                console.error('Translation error:', error);
                return text; // Return original text if translation fails
            }
        };

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