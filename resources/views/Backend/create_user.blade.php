@extends('layouts.backend_template')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" >
            <h1 class="col-lg-pull-6">
                Add User
            </h1>
            <br>
            <br>
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
                <div class="col-md-8">
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
                            <form action="{{route('user.store')}}" method="post" class="form-horizontal">
{{--                                {{!!@csrf_field()}}--}}

                                {{--<div class="row">--}}
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" onkeyup="this.value = this.value.toLowerCase();">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password </label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                {{----}}
                                    {{--<div class="col-md-12">--}}
                                       {{--<strong> Name </strong>--}}
                                        {{--<strong> :</strong>--}}
                                        {{--<input type="text" name="name" class="form-control" placeholder="Name">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<strong>Email : </strong>--}}
                                        {{--<input type="email" name="email" class="form-control" placeholder="Email">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-12">--}}
                                        {{--<strong>Password : </strong>--}}
                                        {{--<input type="password" name="password" class="form-control" placeholder="Password">--}}
                                    {{--</div>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{route('user.index')}}" class="btn btn-success">Back</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary" >Submit</button>
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
