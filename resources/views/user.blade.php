<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
   <h2>پیام ها</h2>

   <h2>okeye</h2>

    @php
        $count = count($chats);
    @endphp

    @for ($i = 0; $i < $count; $i++)

    <h2>{{$chats[$i]['message']}}</h2>

    <ul id="phone-list"></ul>

    @endfor

    <div id="messages" class="h-64 overflow-y-scroll">
        <div class="bg-gray-100 text-gray-800 p-3 rounded-lg m-2 self-start">
            <p>This is a message from another user.</p>
            <div class="text-right text-sm text-gray-500">User Name, 10:00 AM</div>
        </div>
    </div>

    <div class="mt-4">
        <input type="hidden" id="mobile" value="{{$mobile}}">
        <input type="text" id="messageInput" class="w-full p-2 border rounded" placeholder="Type your message here...">
        <button onclick="send()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition ease-in-out duration-150">Send Message</button>
    </div>
</body>
</html>