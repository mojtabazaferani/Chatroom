<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chats</title>
</head>
<body>
    
    @php
        
        $count = count($chats);

    @endphp

    <a href=""></a>

    <h2>لیست کاربران</h2>

    @for ($i = 0; $i < $count; $i++)
        
    <a href="{{route('payamresan', ['id_to' => $chats[$i]['id_to']])}}">
        <h3> {{$chats[$i]['name_to']}} </h3>
    </a>

    @endfor

</body>
</html>