<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Zip;
use Validator;
use GuzzleHttp\Client;


class ZipController extends Controller
{
    //
    public function index(){
        $schemas = DB::select("SELECT schema_name FROM information_schema.schemata where schema_name not like 'information_schema' and schema_name not like 'pg_%' and schema_name not like 'public'");

        return view('backend/upload_data', ['schemas' => $schemas]);
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }

    public function uploadData(Request $request){

        $schemaName = Input::get('data');
//        dd($schemaName);
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

        // globe-> mengambil isi dari folder yang dipilih
        foreach(glob($filenameZip."/*.shp") as $filename) {
             $filename_new = str_replace("/","\\", $filename);
             $table_name = basename($filename_new, ".shp");
             $table_name_new = str_replace(" ","_", $table_name);
             $schema = 'pertanian';

             $output = shell_exec('"C:\Program Files\PostgreSQL\9.5\bin\shp2pgsql" -I -s 4326 '.$filename_new .' '.$schemaName.'.'.$table_name_new.' | "C:\Program Files\PostgreSQL\9.5\bin\psql" -U postgres -d sitrg');

        }

        $this->deleteDirectory($filenameZip);
        $this->request_workspace($schemaName);

        return redirect('backend/uploadData');

    }

    public function post_workspace(String $name)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:8080/geoserver/rest/workspaces', [
            'auth' => ['admin', 'geoserver'],
            'json' => [
                'workspace' => [
                    'name' => $name
                ]
            ]
        ]);

    }

    public function request_workspace(String $name){
        $client = new Client();
        $res = $client->request('GET', 'http://localhost:8080/geoserver/rest/workspaces/'.$name, [
            'auth' => ['admin', 'geoserver']
        ]);

        //menampilkan json
//        dd((string) $res->getBody());

        $responsArray=json_decode($res->getBody());
//        dd($responsArray->workspace->name);

        if ($responsArray->workspace->name == $name)
            $workspacename = $name;
        else
            $this->post_workspace($name);
        git
    }

    public function post_store(Request $name)
    {
        $client = new Client();

        $res = $client->request('POST', 'http://localhost:8080/geoserver/rest/workspaces/'.$name.'/datastores', [
            'auth' => ['admin', 'geoserver'],
            'form_params' => [
                'dataStore' => [
                    'name' => 'nyc',
                    'connectionParameter' => [
                        'entry' =>[
                            '@key'=>'host' , '$' => 'localhost',
                            '@key'=>'port' , '$' => 5432,
                            '@key'=>'database' , '$' => 'sitrg',
                            '@key'=>'user' , '$' => 'postgres',
                            '@key'=>'passwd' , '$' => 'postgres',
                            '@key'=>'dbtype' , '$' => 'postgis',

                        ]
                    ]
                ]
            ]
        ]);
    }



    public function coba(){

        $this->request_workspace();
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
