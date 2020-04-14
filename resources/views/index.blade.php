<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="keywords" content=""/> 
        <meta name="description" content="" />
		<meta name="theme-color" content="#1b1b1b">
		<meta name="msapplication-navbutton-color" content="#1b1b1b">
		<meta name="apple-mobile-web-app-status-bar-style" content="#1b1b1b">
        <title>Movie Box</title>
        <link rel="shortcut icon" href="{{  asset('images/favicon.png') }}" type="image/x-icon"> 
        <script src="{{ asset('js/app.js') }}" defer></script> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    </head>
    <body>
        <div id="app"></div>   
    </body>
</html>


