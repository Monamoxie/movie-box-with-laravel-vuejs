<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="Movie Box, nollywood, hollywood, movies, netflix"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Movie Box | The Netflix of the modern world</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('components/header')

    @yield('banner')

    @yield('content_area')

    @include('components/footer')

    @yield('custom_script')
</body>
</html>