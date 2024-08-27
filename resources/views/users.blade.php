<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>کاربران</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    <h2>لیست کاربران</h2>

    @php
        $count = count($users);
    @endphp

    @for ($i = 0; $i < $count; $i++)
        

    <a href="{{route('user', ['mobile' => $users[$i]['mobile_number']])}}">

        <h3>Mobile : {{$users[$i]['mobile_number']}}</h3>
        
    </a>

    @endfor

    
    <ul id="phone-list"></ul>
        
</body>
</html>