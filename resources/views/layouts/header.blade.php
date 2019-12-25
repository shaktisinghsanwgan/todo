<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script src="{{ asset('toastr/toastr.min.js') }}" ></script>
    <script src="{{ asset('js/Main.js') }}" ></script>
    <script src="{{ asset('js/searchbar.js') }}" ></script>
    <script src="https://kit.fontawesome.com/4ef387cc25.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/searchbar.css') }}" rel="stylesheet">
    <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

</head>
