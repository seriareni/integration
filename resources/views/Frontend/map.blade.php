@extends('layouts.frontend_template')
@section('title', 'SITRG | Map')

@section('menu')
    <div class="navbar-collapse collapse">
        <div class="menu">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a href="{{ url('frontend/home')}}">Home</a></li>
                <li role="presentation" class="active"><a href="{{url('frontend/map')}}">Peta</a></li>
                <li role="presentation"><a href="{{url('frontend/gallery')}}">Galeri</a></li>
                <li role="presentation"><a href="{{url('frontend/contact')}}">Contact</a></li>
                <li role="presentation"><a href="{{url('login')}}">Login</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">

    </div>
    <div class="jumbotron">
    <section class="box">
        <div class="container">
            <div class="row">
                {{--<div id="map"></div>--}}
                <iframe src="http://localhost/mapbender/application/mapbender_user_yml_imp" style="height:500px;width:100%;"></iframe>
            </div>
        </div>
    </section>
    </div>

    <div class="container">
        <section class="content">


        {{--<iframe src="http://localhost/mapbender/" style="height:500px;width:1050px;"></iframe>--}}
        <!-- Main row -->

        </section>
    </div>

@endsection