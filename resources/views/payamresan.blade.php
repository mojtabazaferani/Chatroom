<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/payamresan.js'])


</head>

<body>
    <div id="app" class="p-6">
        <div id="chatroom" class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-4 bg-gray-200">
                <div class="text-lg font-semibold">Chatroom</div>
            </div>
            <div class="p-4">
                <div id="messages" class="h-64 overflow-y-scroll">
                    @php
                        $count = count($messages);
                    @endphp

                    <div class="flex flex-col" id='message-box' >
                        @for ($i = 0; $i < $count; $i++)
                            @if ($author == $messages[$i]['id_from'])
                                <div class="your-message">
                                    <p>{{ $messages[$i]['message'] }}</p>
                                </div>
                            @else
                                <div class="to-message">
                                    <p>{{ $messages[$i]['message'] }}</p>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="mt-4">
                    <input type="text" id="messageInput" class="w-full p-2 border rounded"
                        placeholder="Type your message here...">
                    <button onclick="sendPayam()"
                        class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition ease-in-out duration-150">Send
                        Message</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const userId = {{ Auth::user()->id }};
    </script>
    
</body>

</html>
