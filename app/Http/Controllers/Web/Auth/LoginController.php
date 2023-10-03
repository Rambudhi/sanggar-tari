<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function formLogin()
    {
        if (Session::get('user_type')) 
        {
            return redirect()->route('home');
        } 

        if (Session::get('user_type_admin')) 
        {
            return redirect()->route('admin::dashboard');
        } 
            
        return view('login.index');
    }

    public function doLogin(Request $request)
    {
        try {
            $user = DB::table('users')->where('email', $request->input('email'))->first();

            if ($user === null)
            {
                return redirect()->route('form-login')->with('error', 'Email Tidak Ditemukan');
            } else {
                $valid_password = Hash::check($request->input('password'), $user->password);

                if (!$valid_password) {
                    return redirect()->route('form-login')->with('error', 'Password anda Salah');
                }

                if ($user->user_type === 'A') {
                    Session::put('email_admin', $user->email);
                    Session::put('id_admin', $user->id);
                    Session::put('user_type_admin', $user->user_type);

                    return redirect()->route('admin::dashboard')->with('success', 'Anda Berhasil Login');
                }

                if ($user->user_type === 'M') {
                    Session::put('email', $user->email);
                    Session::put('id', $user->id);
                    Session::put('user_type', $user->user_type);

                    $rc = DB::table('register_course')->where('id_user', $user->id)->first();

                    if($rc !== null) {
                        Session::put('photo', $rc->photo);
                    }
                    
                    return redirect()->route('home')->with('success', 'Anda Berhasil Login');
                }
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
