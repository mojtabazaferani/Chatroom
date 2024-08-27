<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود به چت</title>
    @vite('resources/js/app.js')
</head>
<body>
    
    <form action="{{route('login')}}" method="post">
        @csrf

        <input type="text" name="mobile_number">

        <br>

        <button type="submit">Login</button>
    </form>
</body>
</html>