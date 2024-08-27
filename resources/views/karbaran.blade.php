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

    @php
        $count = count($users);
    @endphp
    
    <h2 class="text-center"> لیست کاربران </h2>

    @for ($i = 0; $i < $count; $i++)
        
        <a href="{{route('payamresan', ['id_to' => $users[$i]['id']])}}">
            <h3> {{$users[$i]['full_name']}} </h3>
        </a>

    @endfor

</body>
</html>