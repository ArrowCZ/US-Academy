<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Urban Sense Academy">
    <meta name="keywords" content="urban,sense,parkour,academy,trenink">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Matěj Brožek">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0e6cb4">

    <title>US academy</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" />
    <link rel="icon" href="{{ asset('images/favicon.png') }}" />
    <link rel="icon" sizes="64x64" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">

    <script src="https://code.nath.co/src/jQuery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.7.0/jquery.lettering.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
</head>

<body>

    @yield('content')

</body>
</html>
