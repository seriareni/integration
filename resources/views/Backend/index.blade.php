@extends('layouts.backend_template')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            {{--<small>Control panel</small>--}}
        </h1>
        {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
            {{--<li class="active">Dashboard</li>--}}
        {{--</ol>--}}
    </section>


        <!-- Main content -->
    <section class="content">

        <!-- Main row -->
        {{--<div class="row">--}}
            {{--<div class="col-xs-12">--}}
                {{--<div class="box box-primary">--}}
                    {{--<div class="box-header with-border">--}}
                        {{--<h3 class="box-title">Data</h3>--}}
                    {{--</div>--}}
                    {{--<div class="box-body">--}}
                        {{--@if (session('status'))--}}
                            {{--<div class="alert alert-success">--}}
                                {{--{{ session('status') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        {{--<p>Hello--}}
                            {{--{{session()->get('activeUser')->name}}--}}
                        {{--</p>--}}
                        {{--<p>--}}
                        {{--Role--}}
                        {{--{{session()->get('activeUser')->role_id}}--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- /.row (main row) -->
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">USER</span>
                        <span class="info-box-number">5<small></small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-folder-open"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">DATA</span>
                        <span class="info-box-number">10</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-info-circle"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">INFORMASI</span>
                        <span class="info-box-number">10</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

</div>
@endsection
