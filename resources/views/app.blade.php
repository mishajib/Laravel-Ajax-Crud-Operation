<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Ajax Cruds</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Styles -->
    <style>
        /*.flex-center {*/
        /*    align-items: center;*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*}*/


    </style>
</head>
<body>
<div class="flex-center">
    <div class="content">
        @yield('content')
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>
