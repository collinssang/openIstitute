<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('/')}}/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css"/>



    <link rel="stylesheet"
          href="{{url('/')}}/bower_components/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.css"/>
    <link rel="stylesheet" href="{{url('/')}}/bower_components/admin-lte/plugins/summernote/summernote.css">

    <link rel="stylesheet" href="{{url('/')}}/dist/dropzone.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{url('/')}}/dist/bs-stepper/css/bs-stepper.min.css">
    <!--    <link rel="stylesheet" href="{{url('/')}}/css/ashtray-custom.css">-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{url('/')}}/dist/css/bootstrap-select.min.css">

    <!--    custom css-->
    <link rel="stylesheet" href="{{url('/')}}/css/ashtray-custom.css">

    <!--    icons css-->
    <link rel="stylesheet" href="{{url('/')}}/css/rotating-card.css">
    <link rel="stylesheet" href="{{url('/')}}/toastr/toastr.css"/>
    <link rel="stylesheet" href="{{url('/')}}/css/appraisal.css"/>
    @stack('styles')

    @yield('css')
</head>

<body class="skin-blue   ">
<?php use Illuminate\Support\Facades\Auth;

$task = [] ?>
@if (!Auth::guest())
<div class="wrapper">
    <!-- Main Header -->
</div>
@else
<header class="a-main-header">
    <nav class="a-navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="a-navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Open Institute
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->


                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div id="content-wrapper">
    <div class="container-fluid" id="base_u" ur="{{url('/getBirthdays')}}">
        <div class="row">
            <div class="col-lg-12">

                @yield('content')
            </div>
        </div>
    </div>
</div>
@endif

<!-- jQuery 3.1.1 -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script src="{{url('/')}}/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{url('/')}}/bower_components/admin-lte/plugins/summernote/summernote.js"></script>
<script src="{{url('/')}}/dist/dropzone.js"></script>

<script src="{{url('/')}}/dist/jquery.flot.js"></script>
<script src="{{url('/')}}/dist/jquery.flot.resize.js"></script>
<script src="{{url('/')}}/dist/jquery.flot.pie.js"></script>

<!-- BS-Stepper -->
<script src="{{url('/')}}/dist/bs-stepper/js/bs-stepper.min.js"></script>

<script src="{{url('/')}}/js/ashtray-scrum.js"></script>
<script src="{{url('/')}}/js/custom.js"></script>
<script src="{{url('/')}}/js/ashtray.js"></script>
<script src="{{url('/')}}/js/ashtray-reports.js"></script>
<script src="{{url('/')}}/toastr/toastr.min.js"></script>


<!-- Latest compiled and minified JavaScript -->
<script>
    $(".select2").select2({
        closeOnSelect: false
    });
    $(document).ready(function () {
        // $(document).bind("contextmenu",function(e){
        //     return false;
        // });

        /**
         * Disable right-click of mouse, F12 key, and save key combinations on page
         * By Arthur Collins Sang
         *
         */

        document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
            // alert("Right Click is not allowed");
        }, false);
        document.addEventListener("keydown", function (e) {

            // document.onkeydown = function(e) {
            // "I" key
            if (e.ctrlKey && e.shiftKey && e.keyCode === 73) {
                // alert("The combination of CTRL + shiftKey + I has been disabled");
                disabledEvent(e);
            }
            // "J" key
            if (e.ctrlKey && e.shiftKey && e.keyCode === 74) {
                // alert("The combination of CTRL + shiftKey +J has been disabled");
                disabledEvent(e);
            }
            // "S" key + macOS
            if (e.keyCode === 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                // alert("The combination of CTRL + shiftKey + S has been disabled");
                disabledEvent(e);
            }
            // "U" key
            if (e.ctrlKey && e.keyCode === 85) {
                // alert("The combination of CTRL + shiftKey + U has been disabled");
                disabledEvent(e);
            }
            // "F12" key
            if (e.keyCode === 123) {
                // alert("The F12 key has been disabled");
                disabledEvent(e);
            }

        }, false);

        function disabledEvent(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            } else if (window.event) {
                window.event.cancelBubble = true;
            }
            e.preventDefault();
            return false;

        }
    });



</script>

@include('layouts.modals')

@stack('scripts')
</body>
</html>
