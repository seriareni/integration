<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;
use DB;

class UserController extends Controller
{
    public function index(){

        $users = UserModel::latest()->paginate(5);
        return view('backend/user', compact('users'))->with('i',(request()->input('page',1)-1)*5);
//        return view('backend/user');
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
        return redirect()->route('user.index')
                         ->with('success','new user created successfully');
    }

    public function destroy(){

    }

    public function show(){

    }

    public function edit(){

    }
}
