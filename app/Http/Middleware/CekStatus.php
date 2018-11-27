<?php

namespace App\Http\Middleware;

use Closure;

class CekStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $activeUser = DB::table('users')->where(['email' => $email])->first();

        if(is_null($activeUser)){
            //data gak ada
            $params = [
                'message' => 'Login Gagal, Data tidak ditemukan'
            ];
        }else{
            if($activeUser->password == sha1($password)) {

//              Query data dari tabel user menu dimana id_usermenu=user_id yang sedang aktif;
//              $dataMenu = DB::table('user_menus')->where(['user_id' => $activeUser->role_id])->get();

//              Dijoinkan dengan tabel menus untuk menampilkan label menu nya dimana menus.menu_id = user_menus.menu_id
            $dataMenu = DB::table('user_menus')
                ->join('menus', 'menus.menu_id', '=', 'user_menus.menu_id')
                ->where(['user_menus.user_id' => $activeUser->role_id])->get();
            // dd($dataMenu);

            $request->session()->put('dataMenu',$dataMenu);
            $request->session()->put('activeUser',$activeUser); // activeuser diambil session ke home.
            // dd($activeUser);

            return redirect('backend/home');
             }

        $params = [
            'message' => 'Login Gagal, Password tidak sesuai'
        ];

        }

        return $next($request);
    }
}
