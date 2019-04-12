<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }},width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    {{--<link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">--}}
    {{--@if(config('adminlte.plugins.datatables'))--}}
    {{--<!-- DataTables -->--}}
        {{--<link rel="stylesheet" type="text/css"--}}
              {{--href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">--}}
    {{--@endif--}}
    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}
    {{--<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">--}}

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="app" class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b></b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>S</b>ITRG</span>
            <!-- Branding Image -->
            {{--<a class="navbar-brand" href="{{ url('/') }}">--}}
                {{--{{ config('app.name', 'SITRG') }}--}}
            {{--</a>--}}
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-default navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    {{--<li class="dropdown user user-menu">--}}

                    <!-- Right Side Of Navbar inks -->
                    @if(is_null(Session::get('activeUser')))
                        <li><a href="{{ url('login') }}">Login</a></li>
                        <li><a href="{{ url('register') }}">Register</a></li>
                    @else
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Session::get('activeUser')->email }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                   {{-- <a href="{{ url('logout') }}"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>--}}

                                    <a href="{{ url('logout') }}">
                                        Logout
                                    </a>

                                    {{--<form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>--}}
                                </li>
                            </ul>
                        </li>
                    {{--</li>--}}
                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                {{--<li>--}}
                    {{--<br>--}}
                    {{--<span><a href="#"> {{session()->get('activeUser')->name}}</a></span>--}}
                    {{--<br><br>--}}
                {{--</li>--}}

                <li class="header">MAIN NAVIGATION</li>
                @php
                    $activeMenu = Session::get('activeUser')->getUserMenus;
                @endphp

                @foreach($activeMenu as $num => $data)
                    <li class="treeview">
                        <a href="{{url($data->getMenu->url)}}">
                            <i class="{{$data->getMenu->icon}}"></i>
                            <span>{{$data->getMenu->label}}</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

        @yield('content')

    <footer class="main-footer">
        <div class="pull-right hidden-xs">

        </div>
        <strong>Copyright &copy; 2018/2019 <a href="#">Tugas Akhir | Seria Reni</a>.</strong> All rights
        reserved.
    </footer>

</div>

    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->

    {{--<script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>--}}
{{--    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>--}}

    {{--<script--}}
        {{--src="{{asset('js/jquery.dataTables.min.js')}}"--}}
        {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
        {{--crossorigin="anonymous"></script>--}}

{{--    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>--}}

    {{--<script type="text/javascript">--}}
    {{--$(document).ready( function () {--}}
        {{--$('#myTable').DataTable({--}}
            {{--"processing" : true,--}}
            {{--"serverSide" : true,--}}
            {{--"ajax" : "{{ route('test.getdata')}}",--}}
            {{--"columns" : [--}}
                {{--{"data" : "nama"},--}}
                {{--{"data" : "email"},--}}
            {{--]--}}
        {{--});--}}
    {{--}--}}
    {{--);</script>--}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Morris.js charts -->
    <script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>

    <!-- page script -->
    <script>
        $(function () {
            $('#myTable').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>

<script>
    $(document).ready(function(){
        $("#map").load("http://localhost/mapbender/", function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
                alert("External content loaded successfully!");
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
</script>
</body>
</html>
