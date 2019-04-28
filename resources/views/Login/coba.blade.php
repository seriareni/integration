@extends('layouts.frontend_template')
@section('title', 'SITRG | Login')

@section('menu')
    <div class="navbar-collapse collapse">
        <div class="menu">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="{{ url('login/coba')}}">Login</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

    <section class="box">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="jumbotron">
                        <div class="slider">
                            <div class="img-responsive">
                                <ul class="bxslider">
                                    <li><img src="{{asset('components_user/img/bromo.jpg')}}" alt="" /></li>
                                    <li><img src="{{asset('components_user/img/sby.jpg')}}" alt="" /></li>
                                    <li><img src="#" alt="" /></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-6">
                    <div class="jumbotron">
                        <div class="login-form">
                            <p><br></p>
                            <div class="main-div">
                                <div class="panel">
                                    <h2>Admin Login</h2>
                                    <p>Please enter your email and password</p>
                                </div>

                                @if(!empty($message))
                                    <div class="alert alert-danger">{{$message}}</div>
                                @endif

                                <form id="Login" class="form-horizontal" action="/login/validate" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password"  class="form-control" placeholder="Password">
                                    </div>

                                    <button type="submit" class="btn btn-primary" >Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </section>
@endsection
