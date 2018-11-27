@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                     <div class="alert alert-success">
                            <p>You're login as
                                {{session()->get('activeUser')->name}}

                                </p>
                            <p>
                                Role
                                {{session()->get('activeUser')->role_id}}
                            </p>
                         <p>
                             {{--dATA Berupa array of object--}}
                             @foreach( session()->get('dataMenu') as $data)
                                 {{$data->label}}

                             @endforeach

                         </p>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

