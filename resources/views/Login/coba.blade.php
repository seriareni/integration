@extends('layouts.login')

@section('content')
<div class="login-form">
    <p><br><br></p>
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

@endsection