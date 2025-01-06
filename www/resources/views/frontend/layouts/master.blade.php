<!doctype html>
<html>

<head>
    <title>@yield('title')| {{ env('APP_NAME') }}</title>
    <!-- Meta Tag -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">
    @include('frontend.layouts.head_css')
</head>

<body>
    @include('frontend.layouts.header')

    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
    @yield('content')
    <!-- ============================================================== -->
    <!-- end Content here -->
    <!-- ============================================================== -->

    @include('frontend.layouts.footer')
</body>
<!-- JAVASCRIPT -->
@include('frontend.layouts.footer_js')

</html>
