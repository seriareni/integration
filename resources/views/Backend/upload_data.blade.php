@extends('layouts.backend_template')

@section('content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Upload File
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Upload File</li>
        </ol>
    </section>

    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data</h3>
                    </div>

                    <div class="box-body">
                    <label for="exampleInputFile">File input</label>
                    <p class="help-block">Upload file type .zip</p>
                    <?php

                    echo Form::open(['url'=>'/backend/upload','files'=>'true']);
                    echo Form::file('zip_file', ['class' => 'btn btn-md', 'accept' => 'application/zip', 'id'=>'zip_file']);
                    echo Form::submit('Submit', ['class' => 'btn btn-md btn-primary']);
                    echo Form::close();

                    ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Schema</h3>
                    </div>

                    <div class="box-body">
                        <label for="exampleInputFile"></label>
                        <p class="help-block"></p>



                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $("#zip_file").on('change', function(event) {
            var file = event.target.files[0];
            console.log(file);
            // if(file.size>=100*1024*1024) {
            //     alert("JPG images of maximum 2MB");
            //     $("#zip_file").val(''); //the tricky part is to "empty" the input file here I reset the form.
            //     return;
            // }

            if(!file.type.match('application/zip')) {
                alert("only ZIP file");
                $("#zip_file").val(''); //the tricky part is to "empty" the input file here I reset the form.
                return;
            }

            //     var fileReader = new FileReader();
            //     fileReader.onload = function(e) {
            //         var int32View = new Uint8Array(e.target.result);
            //         //verify the magic number
            //         // for JPG is 0xFF 0xD8 0xFF 0xE0 (see https://en.wikipedia.org/wiki/List_of_file_signatures)
            //         if(int32View.length>4 && int32View[0]==0xFF && int32View[1]==0xD8 && int32View[2]==0xFF && int32View[3]==0xE0) {
            //             alert("ok!");
            //         } else {
            //             alert("only valid JPG images");
            //             $("#form-id").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
            //             return;
            //         }
            //     };
            //     fileReader.readAsArrayBuffer(file);
        });
    });
</script>

@endsection
