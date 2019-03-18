
{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: USER--}}
 {{--* Date: 1/16/2019--}}
 {{--* Time: 5:09 PM--}}
 {{--*/--}}

@extends('layouts.backend_template')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" >
            <h1 class="col-lg-pull-6">
                Edit User
            </h1>
            {{--<small>Control panel</small>--}}


            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
            {{--<li class="active">Dashboard</li>--}}

            {{--</ol>--}}

        </section>


        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row" >
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            {{--<div class="pull-left">--}}
                            {{--<h3 class="box-title"></h3>--}}
                            {{--</div>--}}

                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <Strong>Try input again</Strong>
                                <ul>
                                    @foreach($errors as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="box-body">
                            <form class="form-horizontal" action="{{route('user.update', $user->user_id)}}" method="post" >

                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <input type="hidden" name="_token" value="" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Wilayah</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}" onkeyup="this.value = this.value.toLowerCase();">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" class="form-control"  value="{{$user->password}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <a href="{{route('user.index')}}" class="btn btn-success">Back</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>

                            {{--<p>Hello--}}
                                {{--{{session()->get('activeUser')->name}}--}}
                            {{--</p>--}}
                            {{--<p>--}}
                            {{--Role--}}
                            {{--{{session()->get('activeUser')->role_id}}--}}
                            {{--</p>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->

    </div>
@endsection
