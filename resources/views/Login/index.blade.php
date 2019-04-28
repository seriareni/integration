{{--@extends('layouts.login')--}}
@extends('layouts.login_template')
@section('title', 'SITRG | Login')

@section('menu')
    <div class="navbar-collapse collapse">
        <div class="menu">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a href="{{ url('frontend/home')}}">Home</a></li>
                <li role="presentation"><a href="{{url('frontend/map')}}">Peta</a></li>
                <li role="presentation"><a href="{{url('frontend/gallery')}}">Galeri</a></li>
                <li role="presentation"><a href="{{url('frontend/contact')}}">Contact</a></li>
                <li role="presentation" class="active"><a href="{{ url('login')}}">Login</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <section class="box">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="login-form">
                        <div class="main-div">
                            <br>

                            <h2>Login</h2>
                            <p>Please enter your email and password</p>
                            <br>

                            @if(!empty($message))
                                <div class="alert alert-danger">{{$message}}</div>
                            @endif

                            <form id="Login" class="form-horizontal" action="{{ url('login/validate') }}" method="post">
                                {{ csrf_field() }}
                                <div class="input-group margin-bottom-sm" style="padding-left: 25px; padding-right: 25px">
                                    <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address">
                                </div>
                                <br>
                                <div class="input-group" style="padding-left: 25px; padding-right: 25px">
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input type="password" name="password"  class="form-control" placeholder="Password">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary" >Login</button>
                            </form>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>
@endsection