<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;
use Hash;
use File;
use Exception;
use Config;
use Validator;

class CostumeRentalController extends Controller
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

    public function index(Request $request)
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

            $costume_type = DB::table('costume_type')->get();
            $size = DB::table('size')->get();

            $ketegori_kostum = $request->input('ketegori_kostum');
            $costume_type_name = $request->input('costume_type_name');
            $size_value = $request->input('size');

            $costume_type_list = DB::table('costume_type as ct')
                ->select('ct.id', 'ct.nama')
                ->where(function($query) use($ketegori_kostum, $size_value, $costume_type_name) {
                    if($ketegori_kostum !== null) {
                        $query->where('ct.ketegori_kostum', $ketegori_kostum);
                    }
                    if($size_value !== null) {
                        $query->where('ct.id_size', $size_value);
                    }
                    if($costume_type_name !== null) {
                        $query->where('ct.nama', 'LIKE', '%'.$costume_type_name.'%');
                    }
                })
                ->paginate(10);

                foreach ($costume_type_list as $item) {
                    $item->image = DB::table('costume_type_details')->where('is_favorite', true)->orderBy('id', 'ASC')->pluck('image')->first();
                }

            return view('custome_rental.index', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas', 'size', 'costume_type', 'costume_type_list', 'ketegori_kostum', 'size_value'));
        } else {
        $display_daftar_kursus = 'block';

        return view('auth.index', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
        }
    }

    public function indexCustomeRental(Request $request, $id)
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

            $costume_type_list = DB::table('costume_type as ct')
                ->join('costume_type_details as ctd', 'ctd.id_costume_type', 'ct.id')
                ->select('ct.id as id_costume_type', 'ctd.image', 'ctd.kondisi', 'ctd.aksesoris', 'ctd.bahan', 'ctd.harga', 'ct.nama', 'ctd.stock', 'ctd.id', 'ctd.jangka_waktu_sewa')
                ->where('id_costume_type', $id)
                ->orderBy('ctd.id', 'ASC')
                ->get();

            return view('custome_rental.indexCustome', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas', 'costume_type_list'));
        } else {
            $display_daftar_kursus = 'block';

        return view('auth.index', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
        }
    }

    public function listCustomeRental(Request $request)
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

            $trx_custome_rental = DB::table('trx_custome_rental as tcr')
                ->join('costume_type_details as ctd', 'ctd.id', 'tcr.id_costume_type_detail')
                ->join('costume_type as ct', 'ct.id', 'tcr.id_costume_type')
                ->select('ctd.image', 'ct.nama', 'tcr.quantity', 'tcr.harga', 'tcr.total_harga','tcr.status', 'tcr.id as id_transaksi')
                ->where('tcr.status', 'DIPESAN')
                ->where('tcr.id_user', Session::get('id'))
                ->orderBy('tcr.id', 'DESC')
                ->get();

            return view('custome_rental.listCustom', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas', 'trx_custome_rental'));
        } else {
            $display_daftar_kursus = 'block';

        return view('auth.index', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
        }
    }

    public function addCustomeRental(Request $request) 
    {
        try {
            $data = $request->all();

            $record = [
                'id_user' => $data['id_user'],
                'id_costume_type' => $data['id_costume_type'],
                'id_costume_type_detail' => $data['id_costume_type_detail'],
                'quantity' => $data['quantity'],
                'harga' => (int) str_replace('.', '', $data['harga']),
                'total_harga' => (int) str_replace('.', '', $data['total_harga']),
                'status' => 'DIPESAN'
            ];

            DB::table('trx_custome_rental')->insert($record);

            return response()->json(['code' => true, 'message' => 'Sukes Sewa Kostum']);
        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function listReturnCustomeRental(Request $request)
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

            $trx_custome_rental = DB::table('trx_custome_rental as tcr')
                ->join('costume_type_details as ctd', 'ctd.id', 'tcr.id_costume_type_detail')
                ->join('costume_type as ct', 'ct.id', 'tcr.id_costume_type')
                ->select(
                    'ctd.image', 
                    'ct.nama', 
                    'tcr.quantity', 
                    'tcr.harga', 
                    'tcr.total_harga',
                    'tcr.status', 
                    'tcr.id as id_transaksi', 
                    'tcr.tgl_pembayaran', 
                    'tcr.bukti_pembayaran',
                    'tcr.id_costume_type_detail',
                    'tcr.tgl_pengembalian'
                )
                ->where('tcr.status', 'DIAMBIL')
                ->where('tcr.id_user', Session::get('id'))
                ->orderBy('tcr.id', 'DESC')
                ->get();

            foreach ($trx_custome_rental as $item) {
               $item->object = DB::table('costume_type_details')->where('id', $item->id_costume_type_detail)->first();
            }

            return view('custome_rental.listCustomReturn', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas', 'trx_custome_rental'));
        } else {
            $display_daftar_kursus = 'block';

        return view('auth.index', compact('display', 'display_daftar_kursus', 'kategori', 'display_kelas'));
        }
    }

    public function addReturnCustomeRental(Request $request) 
    {
        try {
            $data = $request->all();

            $rules = [
                'bukti_pembayaran' => 'required|image|mimes:jpeg,jpg,png',
                'tgl_pembayaran' => 'required|string',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('list-return-costume-rental')->with('error', $errors);
            }

            //Move Uploaded File to public folder
            $destinationPath = 'Bukti_Pembayaran_Kostum';
            $myimage = $data['bukti_pembayaran']->getClientOriginalName();
            $data['bukti_pembayaran']->move(public_path($destinationPath), $myimage);

            $url_image = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;

            $update = [
                'bukti_pembayaran' => $url_image,
                'tgl_pembayaran' => $data['tgl_pembayaran'],
                'status' => 'DIBAYAR'
            ];
         
            $trx_custome_rental = DB::table('trx_custome_rental')->where('id', $data['id_transaksi'])->update($update);

            if($trx_custome_rental == true) {
                return redirect()->route('list-return-costume-rental')->with('success', 'Sukses Menambahkan Materi Kursus');
            } else {
                return redirect()->route('list-return-costume-rental')->with('error', 'Gagal Menambahkan Materi Kursus');
            }

        } catch (Exception $e) {
            return redirect()->route('list-return-costume-rental')->with('error', 'Gagal Menambahkan Materi Kursus ' . $e->getMessage());
        }
    }
}
