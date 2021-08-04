<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trang quản trị</title>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css\app.css') }}">
    <link rel="stylesheet" href="{{ asset('css\style-admin\style.css') }}">
    <link rel="stylesheet" href="{{ asset('css\style\admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css\owl-carousel\owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css\owl-carousel\owl.theme.default.css') }}">
</head>
<body>
    @if (Auth('admin')->check())
        <div id="app">
            <index :user="{{ Auth('admin')->user() }}"></index>
        </div>
        @include('ckfinder::setup')
    @else
        @php
            header("Location: /admin/auth/login");
            exit();
        @endphp    
    @endif
    
   
</body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js\main.js') }}"></script>
    <script src="{{ asset('js\owl-carousel\owl.carousel.js')}}"></script>s
</html>