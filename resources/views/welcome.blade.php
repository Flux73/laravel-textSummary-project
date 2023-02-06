<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (Auth::check())    
        <h1>Authenticated</h1>
    @else
        <h1>Not Authenticated</h1>
    @endif
    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
</body>
</html>