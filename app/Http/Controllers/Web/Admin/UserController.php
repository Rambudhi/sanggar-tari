<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use DB;

class UserController extends Controller
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

    public function userActive()
    {
        $user = DB::table('users')->where('user_type', '!=', 'A')->paginate();

         return view('user_active.index', compact('user'));
    }
}
