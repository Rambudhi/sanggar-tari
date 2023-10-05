<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DB;
use Hash;
use File;
use Exception;
use Config;
use Validator;

class DashboardController extends Controller
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
        $dipesan = DB::table('trx_custome_rental')->where('status', 'DIPESAN')->count();
        $dibatalkan = DB::table('trx_custome_rental')->where('status', 'DIBATALKAN')->count();
        $diambil = DB::table('trx_custome_rental')->where('status', 'DIAMBIL')->count();
        $disetujui = DB::table('trx_custome_rental')->where('status', 'DISETUJUI')->count();

        $register_course = DB::table('register_course')
            ->join('register_course_detail', 'register_course_detail.id_register_course' ,'register_course.id')
            ->selectRaw(
                "SUM(CASE WHEN kategori_kursus = 'basic' THEN 1 ELSE 0 END) as Basic,
                SUM(CASE WHEN kategori_kursus = 'junior' THEN 1 ELSE 0 END) as Junior,
                SUM(CASE WHEN kategori_kursus = 'remaja' THEN 1 ELSE 0 END) as Remaja,
                SUM(CASE WHEN kategori_kursus = 'lansia' THEN 1 ELSE 0 END) as Lansia"
            )
            ->get();

        $data = [
            'dipesan' => $dipesan,
            'dibatalkan' => $dibatalkan,
            'diambil' => $diambil,
            'disetujui' => $disetujui,
            'register_course' => $register_course
        ];

         return view('dashboard.index', compact('data'));
    }
}
