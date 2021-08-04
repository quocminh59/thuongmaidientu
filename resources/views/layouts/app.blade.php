<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QuocMinh-PC</title>
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css\app.css') }}">
    <link rel="stylesheet" href="{{ asset('css\style\homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css\owl-carousel\owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css\owl-carousel\owl.theme.default.css') }}">

</head>

<body>
    <div class="app">
        @include('components.header')
        
        @include('components.menu')
       
        <div class="content">
            @yield('content')
        </div>

        @include('components.footer')
    </div>
</body>
<script src="{{ asset('js\app.js') }}"></script>
<script src="{{ asset('js\main.js') }}"></script>
<script src="{{ asset('js\owl-carousel\owl.carousel.js')}}"></script>
</html>
