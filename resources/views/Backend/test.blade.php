@extends('layouts.backend_template')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Test
                <small>Coba</small>
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

                            <table class="table table-hover table-sm" id="userTable" name="userTable">
                                <tr>
                                    <th width="50px"><b>No.</b></th>
                                    <th width="300px"><b>Nama</b></th>
                                    <th width="300px"><b>Email</b></th>
                                    <th width="180px"><b>Action</b></th>
                                </tr>


                                    <tr>
                                        <td><b>{.</b></td>
                                        <td></td>
                                        <td>l</td>
                                        <td>
                                            <form action="" method="post">
                                                <a class="btn btn-primary">Show</a>
                                                <a class="btn btn-warning">Edit</a>

                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                            </table>




                            {{--@if (session('status'))--}}
                                {{--<div class="alert alert-success">--}}
                                    {{--{{ session('status') }}--}}
                                {{--</div>--}}
                            {{--@endif--}}

                            {{--<p>Hello--}}
                                {{--{{session()->get('activeUser')->name}}--}}
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
