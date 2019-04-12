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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>SITRG</span></a>
        </div>

        @yield('menu')

    </div>
</nav>

<div class="slider">
    <div class="img-responsive">
        <ul class="bxslider">
            <li><img src="{{asset('components_user/img/bromo.jpg')}}" alt="" /></li>
            <li><img src="{{asset('components_user/img/sby.jpg')}}" alt="" /></li>
            <li><img src="img/7.jpg" alt="" /></li>
        </ul>
    </div>
</div>

@yield('content')

<footer>
    <div class="inner-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 f-about">
                    <a href="index.html"><h1>cobaaa</h1></a>
                    <p>We possess within us two minds. So far I have written only of the conscious mind. I would now like to introduce you to your second mind, the hidden and mysterious subconscious. Our subconscious mind contains such power.</p>

                </div>
                <div class="col-md-4 l-posts">
                    <h3 class="widgetheading">Latest Posts</h3>
                    <ul>
                        <li><a href="#">This is awesome post title</a></li>
                        <li><a href="#">Awesome features are awesome</a></li>
                        <li><a href="#">Create your own awesome website</a></li>
                        <li><a href="#">Wow, this is fourth post title</a></li>
                    </ul>
                </div>
                <div class="col-md-4 f-contact">
                    <h3 class="widgetheading">Stay in touch</h3>
                    <a href="#">
                        <p><i class="fa fa-envelope"></i> example@gmail.com</p>
                    </a>
                    <p><i class="fa fa-phone"></i> +345 578 59 45 416</p>
                    <p><i class="fa fa-home"></i> Me & Family inc | PO Box 23456 Little Lonsdale St, New York <br> Victoria 8011 USA</p>
                </div>
            </div>
        </div>
    </div>

    <div class="last-div">
        <div class="container">
            <div class="row">
                <div class="copyright">
                    &copy; 2014 Me & Family Multi-purpose theme
                    <div class="credits">
                        <!--
                          All the links in the footer should remain intact.
                          You can delete the links only if you purchased the pro version.
                          Licensing information: https://bootstrapmade.com/license/
                          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=MeFamily
                        -->
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
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

</body>

</html>