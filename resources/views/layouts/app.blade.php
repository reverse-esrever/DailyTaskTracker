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
    <div>
        <a href="{{route('categories.index')}}">Категории</a>
        <a href="{{route('profile.edit')}}">Профиль</a>
    </div>
    @yield('content')
</body>
</html>