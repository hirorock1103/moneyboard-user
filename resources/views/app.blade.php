<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="position:relative">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description">

    <link rel="icon" href="/images/favicon.ico" id="favicon">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/header_logo.png">


    <title>{{ config('app.name', 'MoneyBoard') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/main.css') }}" rel="stylesheet">

    <!-- <script src="https://js.stripe.com/v3"></script> -->

</head>
<body>

    <div id="app"></div>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>
</body>
</html>
