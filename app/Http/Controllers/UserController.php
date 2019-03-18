<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;
use DB;
use Yajra\DataTables;
use Pacuna\Schemas\Facades\PGSchema;

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
        UserModel::create($request->all());
        $this->createSchema($request->get('name'));
        return redirect()->route('user.index')
                         ->with('success','new user created successfully');
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
        $user->delete();
        return redirect()->route('user.index')
                         ->with('success', 'User berhasil dihapus');

    }

    public function createSchema($schemaName)
    {
        $schema = str_replace(" ", "_", $schemaName);
        PGSchema::create($schema);
    }

}
