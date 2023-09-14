<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function registerCourse()
    {
        $register_course = DB::table('register_course')->paginate();

         return view('register_course.list', compact('register_course'));
    }

    public function verifiedCourse(Request $request)
    {
        $update = DB::table('register_course')->where('id', $request->id)->update(['is_verified' => 1]);

        return response()->json(['code' => true, 'message' => 'Sukes Verifikasi']);
    }
}
