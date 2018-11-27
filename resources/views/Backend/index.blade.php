@extends('layouts.backend_template')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>


        <!-- Main content -->
    <section class="content">

        <!-- Main row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data</h3>
                    </div>
                    <div class="box-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

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
