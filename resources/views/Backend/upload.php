@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Menu</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="alert alert-success">
                            {{--DATA Berupa array of object--}}
                            @foreach( session()->get('dataMenu')->sortBy('menu_id') as $data)
                                <p>
                                    <tr>
                                        <td><a href="{{url($data->url)}}">{{$data->label}}</a></td>
                                    </tr>
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload zip file</div>
                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <?php

                        echo Form::open(['url'=>'/backend/upload','files'=>'true']);
                        echo Form::file('zip_file', ['class' => 'btn btn-md btn-info', 'accept' => 'application/zip', 'id'=>'zip_file']);
                        echo Form::submit('Create', ['class' => 'btn btn-md btn-success']);
                        echo Form::close();

                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $("#zip_file").on('change', function(event) {
                var file = event.target.files[0];
                console.log(file);
                // if(file.size>=2*1024*1024) {
                //     alert("JPG images of maximum 2MB");
                //     $("#form-id").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
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
