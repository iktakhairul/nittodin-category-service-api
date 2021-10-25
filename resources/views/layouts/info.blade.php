<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="yip6ksyOV86QCfYblfVsovsjRy1I32Yo2XDmYHpw">
        <title>Dashboard</title>
{{--            <link rel="stylesheet" type="text/css" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/additional.css')}}">--}}
{{--            <link rel="stylesheet" type="text/css" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/fontawesome-free/css/all.min.css')}}">--}}
{{--            <link rel="stylesheet" type="text/css" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/overlayScrollbars/css/OverlayScrollbars.min.css')}}">--}}
{{--            <link rel="stylesheet" type="text/css" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/adminlte/dist/css/adminlte.min.css')}}">--}}
{{--            <link rel="stylesheet" type="text/css" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/responsive.bootstrap.css')}}"/>--}}
{{--            <link rel="stylesheet" type="text/css" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/dataTables.bootstrap.min.css')}}">--}}
{{--            <link rel="stylesheet" type="text/css" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/bootstrap.min.css')}}">--}}
{{--            <link rel="stylesheet" type="text/css" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/datatables.min.css')}}">--}}
{{--            <script type="text/javascript" href="{{\Illuminate\Support\Facades\URL::asset('/public/vendor/datatables.min.js')}}"></script>--}}
            @yield('additional-css')
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0-rc/css/adminlte.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs/1.11.3/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" href="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    </head>
    <body class="sidebar-mini" >
            <div class="wrapper">
                <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown user-menu">
                            <div class="nav-link">
                                <span>
                                    {{ '' }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </nav>
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <a href="{{url('/home')}}" class="brand-link"><span class="brand-text font-weight-light" style="margin-left:40px; font-size: 20px"><b>Nittodin</b>Category</span></a>
                    <div class="sidebar">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                                <li  class="nav-item">
                                    <a class="nav-link" href="{{ url('categories') }}">
                                        <i class="fas fa-fw fa-user "></i>
                                        <p>{{ __('Category') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('groups') }}">
                                        <i class="fas fa-fw fa-box"></i>
                                        <p>{{ __('Group') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('sub-categories') }}">
                                        <i class="fas fa-fw fa-box"></i>
                                        <p>{{ __('Sub-Category') }} </p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
            @yield('additional-js')
    </body>
</html>
