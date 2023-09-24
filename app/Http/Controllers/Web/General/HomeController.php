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
        $display_daftar_kursus = 'none';
        $display_kelas = 'none';
        $kategori = 'none';
        if(Session::get('id')) {
            $rc = DB::table('register_course')
                ->join('register_course_detail', 'register_course_detail.id_register_course', 'register_course.id')
                ->where('id_user', Session::get('id'))
                ->where('is_verified', 1)
                ->orderBy('register_course_detail.id', 'desc')
                ->first();

            $is_verified = isset($rc->is_verified) ? $rc->is_verified : 0;
            if($is_verified === 1) {
                $display = 'none';
                $kategori = ucfirst($rc->kategori_kursus);
                $display_kelas = 'block';
            } else {
                $display_daftar_kursus = 'block'; 
            }
         } else {
            $display_daftar_kursus = 'block';
         }

         return view('home.index', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
    }
}
