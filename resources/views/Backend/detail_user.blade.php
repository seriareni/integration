{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: USER--}}
 {{--* Date: 1/8/2019--}}
 {{--* Time: 9:07 AM--}}
 {{--*/--}}

@extends('layouts.backend_template')
@section('title', 'SITRG | Detail User')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" >
            <h1 class="col-lg-pull-6">
                User Detail
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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-body">
                            <br>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Wilayah</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$user->name}}" disabled>
                                       </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$user->email}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" value="{{$user->password}}" disabled>
                                    </div>
                                </div>
                            </form>

                            <div class="text-right">
                                <a href="{{route('user.index')}}" class="btn btn-success">Back</a>
                            </div>

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
