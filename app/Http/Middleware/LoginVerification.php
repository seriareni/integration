<?php

namespace App\Http\Middleware;

use Closure;

class LoginVerification
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
        if (!$request->session()->exists('activeUser')) {
            return redirect('login');
        }else {
            return $next($request);
        }
    }
}
