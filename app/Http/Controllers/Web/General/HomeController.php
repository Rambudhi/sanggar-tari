<?php

namespace App\Http\Controllers\Web\General;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use DB;

class HomeController extends Controller
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

    public function index()
    {
        $display = 'block';
        $display_kursus = 'none';
        $kategori = '';
         if(Session::get('id')) {
            $rc = DB::table('register_course')->where('id_user', Session::get('id'))->first();
            if(isset($rc->is_verified) == 1) {
                $display = 'none';
                $display_kursus = 'block';
                $kategori = $rc->kategori_kursus;
            } else {
                $display_kursus = 'block'; 
            }
         }
         
         return view('home.index', compact('display', 'display_kursus', 'kategori'));
    }
}
