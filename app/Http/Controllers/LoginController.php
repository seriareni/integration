<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class LoginController extends Controller
{
    public function index(Request $request){
        if($request->session()->exists('activeUser')){
            return redirect('backend/home');
        }
        return view('login/index');
    }

    public function cekLogin(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');

        $activeUser = UserModel::where('email','=', $email)->first();

        if(is_null($activeUser)){
            //data gak ada
            $params = [
                'message' => 'Login Gagal, Data tidak ditemukan'
            ];
        }else{
            if($activeUser->password == sha1($password)){

                $request->session()->put('activeUser',$activeUser); // activeuser diambil session ke home.
               // dd($activeUser);

                return redirect('backend/home');
            }
            $params = [
                'message' => 'Login Gagal, Password tidak sesuai'
            ];
        }

        return view('login.index', $params);

    }

    public function loginMenu(){

        return view('backend/index');
    }

    public function cekLogout(Request $request){

        $request->session()->flash('$activeUser',null);

        Session::flush();
        return redirect('login');
    }

}