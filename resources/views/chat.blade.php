<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body>
<div id="app" class="p-6">
    <div id="chatroom" class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-4 bg-gray-200">
            <div class="text-lg font-semibold">Chatroom</div>
        </div>
        <div class="p-4">
            <div id="messages" class="h-64 overflow-y-scroll">
                <div class="bg-gray-100 text-gray-800 p-3 rounded-lg m-2 self-start">
                    <p>This is a message from another user.</p>
                    <div class="text-right text-sm text-gray-500">User Name, 10:00 AM</div>
                </div>
            </div>
            <div class="mt-4">
                <input type="text" id="messageInput" class="w-full p-2 border rounded" placeholder="Type your message here...">
                <button onclick="sendMessage()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition ease-in-out duration-150">Send Message</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>