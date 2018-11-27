<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Zip;
use Validator;


class ZipController extends Controller
{
    //
    public function index(){
        return view('backend/upload_data');
    }

    public function uploadData(Request $request){

        $uploadedFile = $request->file('zip_file');
        $zipName = time() . '_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move('uploads/', $zipName);

        $zip = Zip::open(public_path('uploads/'.$zipName));
//        $zip->extract(public_path().'uploads\\'.time().$uploadedFile->getClientOriginalName());
        $filenameZip = public_path('uploads/'.time().$uploadedFile->getClientOriginalName());
        $zip->extract($filenameZip);
        $zip->close();

//      Menghapus file zip pada public
        unlink(public_path().'\\uploads\\'.$zipName);

//      $dataSHP = glob($filenameZip."/*.shp"); // mengambil file .shp pada isi zipnya
//      $filename_new = str_replace("/","\\", $dataSHP); // replace / menjadi \

        $root_dir = public_path('uploads/');

        foreach(glob($filenameZip."/*.shp") as $filename) {
             $filename_new = str_replace("/","\\", $filename);
             $table_name = basename($filename_new, ".shp");
             $table_name_new = str_replace(" ","_", $table_name);
             $schema = 'pertanian';

             $output = shell_exec('"C:\Program Files\PostgreSQL\9.5\bin\shp2pgsql" -I -s 4326 '.$filename_new .' '.$schema.'.'.$table_name_new.' | "C:\Program Files\PostgreSQL\9.5\bin\psql" -U postgres -d sitrg');

//           unlink(public_path().'\\uploads\\'.$filenameZip);
        }

        return redirect('backend/uploadData');
    }

    public function coba(){
//        $a = glob(public_path().'/uploads/1542184016SBYkecamatan_Populasi.zip'."/*.shp");
//        "D:\XAMPP\htdocs\sitrg\public/uploads/1542184016SBYkecamatan_Populasi.zip/SBYkecamatan_Populasi.shp"

//        $schemas = shell_exec('"C:\Program Files\PostgreSQL\9.5\bin\psql" -U postgres -d sitrg -c "\dn"');
//        dd($schemas);
//        $schemas = ['aa','ab'];

//        $coba = shell_exec('"C:\Program Files\PostgreSQL\9.5\bin\psql" -U postgres -d sitrg -c "SELECT schema_name FROM information_schema.schemata;"');
          $coba = DB::select('SELECT schema_name FROM information_schema.schemata');
          $coba2 = DB::select("SELECT schema_name FROM information_schema.schemata where schema_name not like 'information_schema' and schema_name not like 'pg_%'");
           dd($coba2);


        return view('backend/test');

    }

    public function show(Request $request){
        return view('backend/data_shp');
    }
}
