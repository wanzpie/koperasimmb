


{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Scripts -->--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}

<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->


<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
{{--<!DOCTYPE html>--}}
{{--<html lang="zxx">--}}
{{--<head>--}}
{{--    <title>MPS BM</title>--}}
{{--    <!-- custom-theme -->--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />--}}
{{--    <meta name="keywords" content="Esteem Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,--}}
{{--Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />--}}
{{--    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);--}}
{{--        function hideURLbar(){ window.scrollTo(0,1); } </script>--}}
{{--    <!-- //custom-theme -->--}}
{{--    <link href="{{ asset('assets/esteem-web/css/bootstrap.css') }} " rel="stylesheet" type="text/css" media="all" />--}}
{{--    <link href="{{ asset('assets/esteem-web/css/component.css') }}" rel="stylesheet" type="text/css" media="all" />--}}

{{--    <link href="{{ asset('assets/esteem-web/css/export.css') }}" rel="stylesheet" type="text/css" media="all" />--}}
{{--    <link href="{{ asset('assets/esteem-web/css/flipclock.css') }}" rel="stylesheet" type="text/css" media="all" />--}}
{{--    <link href="{{ asset('assets/esteem-web/css/circles.css') }}" rel="stylesheet" type="text/css" media="all" />--}}
{{--    <link href="{{ asset('assets/esteem-web/css/style_grid.css') }} " rel="stylesheet" type="text/css" media="all" />--}}
{{--    <link href="{{ asset('assets/esteem-web/css/style.css') }} " rel="stylesheet" type="text/css" media="all" />--}}

{{--    <!-- font-awesome-icons -->--}}
{{--    <link href="{{ asset('assets/esteem-web/css/font-awesome.css') }} " rel="stylesheet">--}}
{{--    <!-- //font-awesome-icons -->--}}
{{--    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">--}}

{{--    <!-- Datatables -->--}}
{{--    <link href="{{ asset('assets/esteem-web/css/dataTables.bootstrap.min.css') }} " rel="stylesheet">--}}
{{--</head>--}}

{{--<body>--}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Koperasi MMB</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href=" {{ asset('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href=" {{ asset('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- datepicker -->
    <link rel="stylesheet" href=" {{ asset('assets/AdminLTE/plugins/datepicker/datepicker.css') }}">
    {{--select 2--}}
    <link rel="stylesheet" href=" {{ asset('assets/AdminLTE/plugins/select2/css/select2.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/toastr/toastr.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Tempusdominus Bbootstrap 4 -->

    <!-- Bootstrap4 Duallistbox -->
{{--    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">--}}
{{--    <!-- Theme style -->--}}
    <link rel="stylesheet" href="{{ asset('assets/AdminLTE/dist/css/adminlte.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />


    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>--}}

    {{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            const Toast = Swal.mixin({--}}
{{--                toast: true,--}}
{{--                position: 'top-end',--}}
{{--                showConfirmButton: false,--}}
{{--                timer: 3000--}}
{{--            });--}}

{{--            @if(Session::has('success'))--}}

{{--            toastr.success("{{ Session::get('success') }}");--}}

{{--            @endif--}}


{{--            @if(Session::has('info'))--}}

{{--            toastr.info("{{ Session::get('info') }}");--}}

{{--            @endif--}}


{{--            @if(Session::has('warning'))--}}

{{--            toastr.warning("{{ Session::get('warning') }}");--}}

{{--            @endif--}}


{{--            @if(Session::has('error'))--}}

{{--            toastr.error("{{ Session::get('error') }}");--}}

{{--            @endif--}}
{{--        });--}}
{{--    </script>--}}
</head>
{{--<body class="hold-transition sidebar-mini {{ Auth::user() ? ' layout-navbar-fixed layout-fixed' : 'login-page' }}">--}}
<body class="hold-transition sidebar-mini
{{--{{ Auth::user() ? ' layout-navbar-fixed layout-fixed' : 'login-page' }}"--}}
@if(Session::get('id'))
    layout-navbar-fixed layout-fixed
    @else
    login-page
    @endif
    ">
<div class="wrapper">

    @if(Session::get('id'))
        @include('layouts.navbar')
        {{--        @include('layouts.flash-message')--}}

    @endif
    @yield('content')
    @include('layouts.footer')
</div>



