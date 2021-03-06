@extends('layouts.frontend_template')
@section('title', 'SITRG | Home')

@section('menu')
    <div class="navbar-collapse collapse">
        <div class="menu">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="{{ url('frontend/home')}}">Home</a></li>
                <li role="presentation"><a href="{{url('frontend/map')}}">Peta</a></li>
                <li role="presentation"><a href="{{url('frontend/gallery')}}">Galeri</a></li>
                <li role="presentation"><a href="{{url('frontend/contact')}}">Contact</a></li>
                <li role="presentation"><a href="{{url('login')}}">Login</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <div class="slider">
        <div class="img-responsive">
            <ul class="bxslider">
                <li><img src="{{asset('components_user/img/bromo.jpg')}}" alt="" /></li>
                <li><img src="{{asset('components_user/img/sby.jpg')}}" alt="" /></li>
                <li><img src="#" alt="" /></li>
            </ul>
        </div>
    </div>

    <div class="jumbotron">
        <h1>SITRG</h1>
        <p>
            praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint <br> Voluptatem accusantium doloremque laudantium sprea totam rem aperiam
        </p>
    </div>

    <div class="container">
        <div class="col-md-6">
            <img src="#" alt="" class="img-responsive" />
        </div>
        <div class="col-md-6">
            <img src="#" alt="" class="img-responsive" />
        </div>
    </div>
    <section class="box">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="wow bounceIn" data-wow-offset="0" data-wow-delay="0.4s">
                        <div class="services">
                            <div class="icons">
                                <i class="fa fa-heart-o fa-3x"></i>
                            </div>
                            <h4>Events</h4>
                            <p>
                                praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="col-md-4">
                    <div class="wow bounceIn" data-wow-offset="0" data-wow-delay="0.8s">
                        <div class="services">
                            <div class="icons">
                                <i class="fa fa-desktop fa-3x"></i>
                            </div>
                            <h4>Fresh</h4>
                            <p>
                                praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="col-md-4">
                    <div class="wow bounceIn" data-wow-offset="0" data-wow-delay="1.2s">
                        <div class="services">
                            <div class="icons">
                                <i class="fa fa-thumbs-o-up fa-3x"></i>
                            </div>
                            <h4>likes</h4>
                            <p>
                                praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="wow bounceIn" data-wow-offset="0" data-wow-delay="0.4s">
                        <div class="services">
                            <div class="icons">
                                <i class="fa fa-leaf fa-3x"></i>
                            </div>
                            <h4>Business Family</h4>
                            <p>
                                praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="wow bounceIn" data-wow-offset="0" data-wow-delay="0.8s">
                        <div class="services">
                            <div class="icons">
                                <i class="fa fa-laptop fa-3x"></i>
                            </div>
                            <h4>Free Support</h4>
                            <p>
                                praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="wow bounceIn" data-wow-offset="0" data-wow-delay="1.2s">
                        <div class="services">
                            <div class="icons">
                                <i class="fa fa-camera fa-3x"></i>
                            </div>
                            <h4>Photography</h4>
                            <p>
                                praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </section>
@endsection