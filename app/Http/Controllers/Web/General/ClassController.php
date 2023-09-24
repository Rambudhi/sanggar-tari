<?php

namespace App\Http\Controllers\Web\General;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use DB;

class ClassController extends Controller
{
    public function index($kat)
    {
        $display = 'block';
        $display_daftar_kursus = 'none';
        $display_kelas = 'none';
        $kategori = $kat;
         if(Session::get('id')) {
            $rc = DB::table('register_course')
                ->join('register_course_detail', 'register_course_detail.id_register_course', 'register_course.id')
                ->where('id_user', Session::get('id'))
                ->where('kategori_kursus', $kat)
                ->orderBy('register_course_detail.id', 'desc')
                ->first();
            
            $is_verified = isset($rc->is_verified) ? $rc->is_verified : 0;

            if($is_verified === 1) {
                $display = 'none';
                $display_daftar_kursus = 'none';
                $display_kelas = 'block';

                $kategori_materi = DB::table('kategori_materi')->where('kategori_kursus', strtolower($kat))->paginate(10);

                return view('class.index' . $kat, compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas', 'kategori_materi'));
            } else if($is_verified === 0) {
                $display = 'none';
                $display_daftar_kursus = 'none';
                $display_kelas = 'block';

                if ($rc !== null) {
                    return view('register_course.waiting_verification', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
                } else {
                    return view('register_course.indexNext', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
                }
            } else {
                return view('register_course.waiting_verification', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
            }
         } else {
            $display_daftar_kursus = 'block';

            return view('auth.index', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
         }
    }

    public function indexDetail($kat, $id)
    {
        $display = 'block';
        $display_daftar_kursus = 'none';
        $display_kelas = 'none';
        $kategori = $kat;
         if(Session::get('id')) {
            $rc = DB::table('register_course')
                ->join('register_course_detail', 'register_course_detail.id_register_course', 'register_course.id')
                ->where('id_user', Session::get('id'))
                ->where('kategori_kursus', $kat)
                ->orderBy('register_course_detail.id', 'desc')
                ->first();
            
            $is_verified = isset($rc->is_verified) ? $rc->is_verified : 0;

            if($is_verified === 1) {
                $display = 'none';
                $display_daftar_kursus = 'none';
                $display_kelas = 'block';

                $kategori_materi_detail = DB::table('kategori_materi_detail')->where('id_kategori_kursus', $id)->orderBy('order_seq', 'ASC')->get();

                return view('class.index' . $kat .'Video', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas', 'kategori_materi_detail'));
            } else if($is_verified === 0) {
                $display = 'none';
                $display_daftar_kursus = 'none';
                $display_kelas = 'block';

                if ($rc !== null) {
                    return view('register_course.waiting_verification', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
                } else {
                    return view('register_course.indexNext', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
                }
            } else {
                return view('register_course.waiting_verification', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
            }
         } else {
            $display_daftar_kursus = 'block';

            return view('auth.index', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
         }
    }
}
