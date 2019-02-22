{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: USER--}}
 {{--* Date: 1/8/2019--}}
 {{--* Time: 9:07 AM--}}
 {{--*/--}}

@extends('layouts.backend_template')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" >
            <h1 class="col-lg-pull-6">
                User Detail
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
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <strong>Name : </strong> {{$user->name}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Email : </strong> {{$user->email}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{route('user.index')}}" class="btn btn-success">Back</a>
                            </div>

                            <p>Hello
                                {{session()->get('activeUser')->name}}
                            </p>
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
