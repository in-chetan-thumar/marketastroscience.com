<!doctype html>
<!-- saved from url=(0058)https://www.wealcoder.com/dev/html/axtra/index-2-dark.html -->
<html lang="en" style="overscroll-behavior: none; scroll-behavior: smooth;">

<head>
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Axtra HTML5 Template">

    @include('frontend.layouts.head_css')
</head>

<body class="" cz-shortcut-listen="true"
    style="height: 10825px; overscroll-behavior: none; scroll-behavior: auto;">
    @include('frontend.layouts.cursor_animation')
    @include('frontend.layouts.preloader')
    {{-- @include('frontend.layouts.switcher_area') --}}
    @include('frontend.layouts.scroll')
    @include('frontend.layouts.header')
    @include('frontend.layouts.offcanvas_area')
    <div id="smooth-wrapper" style="inset: 0px; width: 100%; height: 100%; position: fixed; overflow: hidden;">
        <div id="smooth-content"
            style="translate: none; rotate: none; scale: none; transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1); box-sizing: border-box; width: 100%; overflow: visible;">
            <!-- ============================================================== -->
            <!-- Start Content here -->
            <!-- ============================================================== -->
            @yield('content')
            <!-- ============================================================== -->
            <!-- end Content here -->
            <!-- ============================================================== -->

            @include('frontend.layouts.footer')
        </div>
    </div>
</body>
<!-- JAVASCRIPT -->
@include('frontend.layouts.footer_js')

</html>
