<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href='{{asset("favicon/apple-touch-icon.png")}}'>
    <link rel="icon" type="image/png" sizes="32x32" href='{{asset("favicon/favicon-32x32.png")}}'>
    <link rel="icon" type="image/png" sizes="16x16" href='{{asset("favicon/favicon-16x16.png")}}'>
    <link rel="manifest" href='{{asset("favicon/site.webmanifest")}}'>
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="https://v1.fontapi.ir/css/Vazir" rel="stylesheet">
    <link rel="stylesheet" href='{{asset("/css/frontend/style.css")}}'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <script src="{{ asset("js/libraries/jquery.min.js") }}"></script> <!-- Jquery -->
    <title>@yield('title')</title>
    @vite('resources/css/app.css') <!-- TailWind Styles -->
</head>
