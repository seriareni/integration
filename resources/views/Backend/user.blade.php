@extends('layouts.backend_template')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User
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
                            <div class="pull-right">
                                {{--route ini berdasarkan dari web pada routes yaitu route::resource user. Index disini mengarah pada Usercontroler fungsi index--}}
                             <a class="btn btn-success" href=" {{route('user.create')}} "><i class="fa fa-user-plus"></i> Add User</a>
                            </div>
                        </div>

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{$message}}</p>
                            </div>
                        @endif

                        <div class="box-body">

                            <table class="table table-hover table-sm">
                                <tr>
                                    <th width="50px"><b>No.</b></th>
                                    <th width="300px"><b>Nama</b></th>
                                    <th width="300px"><b>Email</b></th>
                                    <th width="180px"><b>Action</b></th>
                                </tr>

                                @foreach($users as $user)
                                    <tr>
                                        <td><b>{{++$i}}.</b></td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <form action="{{route('user.destroy',$user->id)}}" method="post">
                                                <a class="btn btn-primary" href="{{route('user.show', $user->id)}}">Show</a>
                                                <a class="btn btn-warning" href="{{route('user.edit', $user->id)}}">Edit</a>

                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
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