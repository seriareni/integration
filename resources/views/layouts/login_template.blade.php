<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }},width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('components_user/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('components_user/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('components_user/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('components_user/css/jquery.bxslider.css')}}">
    <link href="{{asset('components_user/css/style.css')}}" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><span>SITRG</span></a>
        </div>

        @yield('menu')

    </div>
</nav>

@yield('content')

<footer>
    <div class="last-div">
        <div class="container">
            <div class="row">
                <div class="copyright">
                    &copy; 2019 Tugas Akhir Seria Reni DA - Bismillah
                    <div class="credits">
                        <!--
                          All the links in the footer should remain intact.
                          You can delete the links only if you purchased the pro version.
                          Licensing information: https://bootstrapmade.com/license/
                          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=MeFamily
                        -->
                        {{--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>--}}
                    </div>
                </div>


                {{--<ul class="social-network">--}}
                {{--<li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook fa-1x"></i></a></li>--}}
                {{--<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter fa-1x"></i></a></li>--}}
                {{--<li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin fa-1x"></i></a></li>--}}
                {{--<li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest fa-1x"></i></a></li>--}}
                {{--<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus fa-1x"></i></a></li>--}}
                {{--</ul>--}}
            </div>
        </div>
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('components_user/js/jquery-2.1.1.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('components_user/js/bootstrap.min.js')}}"></script>
<script src="{{asset('components_user/js/wow.min.js')}}"></script>
<script src="{{asset('components_user/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('components_user/js/jquery.bxslider.min.js')}}"></script>
<script src="{{asset('components_user/js/jquery.isotope.min.js')}}"></script>
<script src="{{asset('components_user/js/fancybox/jquery.fancybox.pack.js')}}"></script>
<script src="{{asset('components_user/js/functions.js')}}"></script>
<script>
    wow = new WOW({}).init();
</script>
<script>
    $(document).ready(function(){
        $("#map").load("http://localhost/mapbender/application/mapbender_user_yml_imp", function(responseTxt, statusTxt, xhr){
            if(statusTxt == "success")
            // alert("External content loaded successfully!");
                if(statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });
</script>

</body>

</html>