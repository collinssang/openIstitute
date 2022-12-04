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
    <header class="a-main-header ">

        <!-- Logo -->
        <!-- Header Navbar -->
        <nav class="a-navbar  navbar-static-top" role="navigation">

            <!-- Navbar Right Menu -->

            <div class="navbar-custom-menu">
                <div class="row erp-logo">OpenInst</div>
                <br>
                <ul class="nav navbar-nav">
                    <?php
                    $modelname = \App\Models\Leave::class;
                    $notificaitonCount = \App\Models\Notification::where('status', '0')
                        ->where('recipient_id', Auth::id())
                        ->count();
                    $leaves_count = \App\Models\Notification::where('model_name', $modelname)
                        ->where('recipient_id', Auth::id())
                        ->where('status', '0')
                        ->count();

                    $adminLeaveApprove = App\Models\Leave::where('user_id', Auth::user()->id)->where('leave_status', 2)->orWhere('leave_status', 1)->count();

                    $totalNotifications = '';

                        $totalNotifications = $notificaitonCount;

                    ?>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">
                                {{$totalNotifications}}
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have
                                <label class="badge badge-label-success">
                                    {{$totalNotifications}}
                                </label> &nbsp;  notifications
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    {{--                                        <li>--}}
                                        {{--                                            @if(Auth::user()->hasRole('admin'))--}}
                                        {{--                                                @if(Auth::user()->can('approve-leave'))--}}
                                        {{--                                                    <a href="{{url('/leave_request')}}" class="dropdown-item d-block">--}}
                                            {{--                                                        <div class="small mb-1"><i class="fa fa-users text-aqua"></i>--}}
                                                {{--                                                            Leave Requests--}}
                                                {{--                                                            <span class="float-right">--}}
{{--                                                    <label class="label label-danger">--}}
{{--                                                            <strong>--}}
{{--                                                                {{$adminLeaveApprove}}--}}
{{--                                                            </strong>--}}
{{--                                                    </label>--}}
{{--                                                        </span>--}}
                                                {{--                                                        </div>--}}
                                            {{--                                                        <span class="progress progress-xs">--}}
{{--                                                <div class="progress-bar bg-info" role="progressbar" style="width: 0%"--}}
                                                         {{--                                                     aria-valuenow="0"--}}
                                                         {{--                                                     aria-valuemin="0" aria-valuemax="100">--}}

{{--                                                </div>--}}
{{--                                            </span>--}}
                                            {{--                                                    </a>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </li>--}}
                                    {{--                                        <li>--}}
                                        {{--                                            <a href="{{url('/leaves_notice')}}">--}}
                                            {{--                                                <i class="fa fa-users text-aqua"></i>--}}
                                            {{--                                                Leave Notification(s)--}}
                                            {{--                                                <label class="label label-danger">--}}
                                                {{--                                                    {{$leaves_count}}--}}
                                                {{--                                                </label>--}}
                                            {{--                                            </a>--}}
                                        {{--                                        </li>--}}
<!---->
                                </ul>
                            </li>
                        </ul>
                    </li>


                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle profile-img" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            @if(Auth::user()->profile_img_url)
                            <img src="{{ Auth::user()->profile_img_url }}"
                                 class="user-image" alt="User Image"/>
                            @else

                            <img src="{{url('/css/icons/profile.svg')}}"
                                 class="user-image " alt="User Image"/>
                            @endif

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->firstName }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                @if(Auth::user()->profile_img_url)
                                <img src="{{ Auth::user()->profile_img_url }}"
                                     class="img-circle" alt="User Image"/>
                                @else

                                <img src="{{url('/css/icons/profile.svg')}}"
                                     class="img-circle" alt="User Image"/>
                                @endif

                                <p>
                                    {{ Auth::user()->firstName }}
                                    <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('/profiles')}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Main Footer -->
    <footer class="main-footer" style="max-height: 100px;text-align: center" ur="{{url('/getBirthdays')}}">
        <strong>Copyright © {{date('Y')}} <a href="#">{{ config('app.name') }}</a>.</strong> All rights reserved.
    </footer>

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
</script>

@include('layouts.modals')

@stack('scripts')
</body>
</html>
