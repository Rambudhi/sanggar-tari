<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;
use Hash;


class RegisterController extends Controller
{
    public function formRegister()
    {
        return view('register.index');
    }

    public function doRegister(Request $request)
    {
        $email = $request->input('email');
        $pass = Hash::make($request->input('password'));
        $pass_confirm = Hash::make($request->input('password_confirm'));
        $user_type = 'M';
        $is_active = 1;
        $is_verified = 1;

        DB::table('users')->insert([
            'email' => $email,
            'password' => $pass,
            'password_confirm' => $pass_confirm,
            'user_type' => $user_type,
            'is_active' => $is_active,
            'is_verified' => $is_verified
        ]);

        return redirect()->route('form-login')->with('success', 'Berhasil Daftar');
    }
}
