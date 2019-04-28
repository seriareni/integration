<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;
use DB;
use Yajra\DataTables;
use Pacuna\Schemas\Facades\PGSchema;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function index(){
        $users = UserModel::all();
//        $users = UserModel::latest()->paginate(10);
//        return view('backend/user', compact('users'))->with('i',(request()->input('page',1)-1)*5);
        return view('backend/user', compact('users'))->with('i');
    }

    public function create(){
        return view('backend.create_user');
    }

    public function store(Request $request){
        $request->validate([
           'name' => 'required',
           'email' => 'required',
            'password' => 'required',
        ]);

        $search = UserModel::where(['email'=>$request->input('email')])->first();

        if ($search == null){
//            echo "belum ada datanya, jadi bisa ditambahkan";
            UserModel::create($request->all());
            $this->createSchema($request->get('name'));
            return redirect()->route('user.index')
                             ->with('success','new user created successfully');
        } else{
//            echo "udah ada data tidak bisa ditambah lagi";
            return redirect()->route('user.create')
                             ->with('warning','Data elready exist !!');
        }

    }

    public function show($id){
        $user = UserModel::find($id);
        return view('backend.detail_user', compact('user'));

    }

    public function edit($id){
        $user = UserModel::find($id);
        return view('backend.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = UserModel::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');

        $user->save();
        return redirect()->route('user.index')
                         ->with('success', 'Biodata user berhasil diupload');
    }

    public function destroy($id){


        $user = UserModel::find($id);
        $schemaName = $user->name;
        $schema = str_replace(" ", "_", $schemaName);
        $user->delete();
        PGSchema::drop($schema);
        $this->getWorkspace($schema);

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil dihapus');

    }

    public function createSchema($schemaName)
    {
        $schema = str_replace(" ", "_", $schemaName);
//        cek apakah sudah ada user yang sama atau tidak.. jika sama alert
        PGSchema::create($schema);
    }

    public function delete($id)
    {
        $user = UserModel::find($id);
        $schemaName = $user->name;
        dd($schemaName);

        $schema = str_replace(" ", "_", $schemaName);
        $user->delete();
        PGSchema::drop($schema);
        $this->getWorkspace($schema);

        return redirect()->route('user.index');
    }

    public function getWorkspace($name)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://localhost:8080/geoserver/rest/workspaces/', [
            'auth' => ['admin', 'geoserver']
        ]);

        $responsArray = json_decode($res->getBody());

        foreach ($responsArray->workspaces as $num => $item) {
            foreach ($item as $no => $piece) {
                $resultname = $piece->name;

                if ($name == $resultname){
                    $result=1;
                    $this->delete_workspace($name);
                    break;
                }
                else{
                    $result=0;
                }
            }
            if ($result==0) {

            }
        }
    }

    public function delete_workspace($name)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/geoserver/rest/workspaces/". $name ."?recurse=true");
        curl_setopt($ch, CURLOPT_HTTPHEADER,  array("Content-type: application/json", 'Authorization: Basic YWRtaW46Z2Vvc2VydmVy'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        $str = curl_exec($ch);

        curl_close($ch);
    }
}
