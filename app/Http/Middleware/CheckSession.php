<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;

class CheckSession
{
    public function handle($request, Closure $next)
    {
        if(Session::get('user_type') === 'M') {
            $record = DB::table('users')->where('id', $request->session()->get('id'))->first();

            if ($request->session()->get('email') || $record !== null) {
                // user value cannot be found in session
                return $next($request);
            }

            Session::flush();
            Session::save();

            return redirect('/');
        } 
        
        if (Session::get('user_type_admin') === 'A') {
            if ($request->session()->get('email_admin')) {
                // user value cannot be found in session
                return $next($request);
            }

            return redirect('/');
        }

        if($request->route()->getName() == 'form-register-course')
        {
            return redirect()->route('form-login');
        }

        return redirect()->route('home');
    }
}
