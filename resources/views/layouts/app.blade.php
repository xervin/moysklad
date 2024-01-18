<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Мой Склад</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/bootstrap.js') }}" ></script>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Selectivity.js/2.1.0/selectivity-full.min.css">--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Selectivity.js/2.1.0/selectivity-full.min.js"></script>--}}

    @yield('head')
</head>
<body>
@yield('header')
<main class="content">
    @yield('content')
</main>
@yield('footer')
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Selectivity.js/2.1.0/selectivity-full.min.js"></script>--}}
<script src="{{ mix('js/app.js') }}" ></script>
</body>
</html>
