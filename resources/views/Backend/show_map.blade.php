@extends('layouts.backend_template')
@section('title', 'SITRG | Data SHP')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Map
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">MapBender</li>
        </ol>
    </section>

        <!-- Main content -->
    <section class="content">
        <div id="map"></div>

    {{--<iframe src="http://localhost/mapbender/" style="height:500px;width:1050px;"></iframe>--}}
        <!-- Main row -->

    </section>
    <!-- /.content -->
</div>
@endsection

