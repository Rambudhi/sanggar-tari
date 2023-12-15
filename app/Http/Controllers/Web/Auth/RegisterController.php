<?php

namespace App\Http\Controllers\Web\Auth;

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

    public function formRegisterCourse()
    {
        if (Session::get('user_type') === null) {
            return view('login.index');
        } else {
            $display = 'block';
            $display_kelas = 'none';
            $display_daftar_kursus  = 'block';
            $kategori = 'none';
            $rc = DB::table('register_course')
                ->join('register_course_detail', 'register_course_detail.id_register_course', 'register_course.id')
                ->where('id_user', Session::get('id'))
                ->exists();

            $schedule_course = DB::table('schedule_course')->get();

            if(!$rc){
                return view('register_course.index', compact('display', 'display_kelas', 'display_daftar_kursus', 'kategori', 'schedule_course'));
            } else {
                return view('register_course.waiting_verification', compact('display', 'display_kelas', 'display_daftar_kursus', 'kategori'));
            }
        }
    }

    public function uploadPhoto(Request $request) {
        try {
            $data = $request->all();

            $rules = [
                'photo_file' => 'required|mimes:jpeg,png',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return response()->json(['code' => false, 'message' => $errors]);
            }
         
            //Move Uploaded File to public folder
            $destinationPath = 'PHOTO';
            $myimage = $data['photo_file']->getClientOriginalName();
            $data['photo_file']->move(public_path($destinationPath), $myimage);

            $url = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;

            $data = [
                'url' => $url,
                'image_name' => $myimage
            ];

            return response()->json(['code' => true, 'message' => 'Sukes Upload Photo', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function uploadKK(Request $request) {
        try {
            $data = $request->all();

            $rules = [
                'kk_file' => 'required|mimes:jpeg,png',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return response()->json(['code' => false, 'message' => $errors]);
            }
         
            //Move Uploaded File to public folder
            $destinationPath = 'KK';
            $myimage = $data['kk_file']->getClientOriginalName();
            $data['kk_file']->move(public_path($destinationPath), $myimage);

            $url = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;

            $data = [
                'url' => $url,
                'image_name' => $myimage
            ];

            return response()->json(['code' => true, 'message' => 'Sukes Upload KK', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function uploadBuktiPembayaran(Request $request) {
        try {
            $data = $request->all();

            $rules = [
                'bp_file' => 'required|mimes:jpeg,png',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return response()->json(['code' => false, 'message' => $errors]);
            }
         
            //Move Uploaded File to public folder
            $destinationPath = 'BP';
            $myimage = $data['bp_file']->getClientOriginalName();
            $data['bp_file']->move(public_path($destinationPath), $myimage);

            $url = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;

            $data = [
                'url' => $url,
                'image_name' => $myimage
            ];

            return response()->json(['code' => true, 'message' => 'Sukes Upload PB', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function doInsertRegisterCourse(Request $request) {
        try {
            $data = $request->all();

            if($data['kartu_keluarga'] === 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg') {
                $data['kartu_keluarga'] = '';
            }

            if($data['bukti_pembayaran'] === 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg') {
                $data['bukti_pembayaran'] = '';
            }

            $rules = [
                'nama_depan' => 'required',
                'pendidikan' => 'required',
                'nama_belakang' => 'required',
                'nomor_telepon' => 'required',
                'photo' => 'required',
                'kartu_keluarga' => 'required',
                'bukti_pembayaran' => 'required',
                'kategori_kursus' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'provinsi' => 'required',
                'kode_pos' => 'required',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return response()->json(['code' => false, 'message' => $errors]);
            }

            $insert = [
                'id_user' => $data['id_user'],
                'nama_depan' => $data['nama_depan'],
                'pendidikan' => isset($data['pendidikan']) ? $data['pendidikan'] : null,
                'nama_belakang' => $data['nama_belakang'],
                'nomor_telepon' => isset($data['nomor_telepon']) ? $data['nomor_telepon'] : null,
                'photo' => isset($data['photo']) ? $data['photo'] : null,
                'nama_ortu' => isset($data['nama_ortu']) ? $data['nama_ortu'] : null,
                'nomor_telepon_ortu' => isset($data['nomor_telepon_ortu']) ? $data['nomor_telepon_ortu'] : null,
                'pekerjaan_ortu' => isset($data['pekerjaan_ortu']) ? $data['pekerjaan_ortu'] : null,
                'alamat' => isset($data['alamat']) ? $data['alamat'] : null,
                'kota' => isset($data['kota']) ? $data['kota'] : null,
                'provinsi' => isset($data['provinsi']) ? $data['provinsi'] : null,
                'kode_pos' => isset($data['kode_pos']) ? $data['kode_pos'] : null,
                'kartu_keluarga' => isset($data['kartu_keluarga']) ? $data['kartu_keluarga'] : null,
            ];

            Session::put('photo', $data['photo']);
         
            $id_register_course = DB::table('register_course')->insertGetId($insert);

            $details = [
                'id_register_course' => $id_register_course,
                'bukti_pembayaran' => isset($data['bukti_pembayaran']) ? $data['bukti_pembayaran'] : null,
                'kategori_kursus' => isset($data['kategori_kursus']) ? $data['kategori_kursus'] : null,
            ];

            DB::table('register_course_detail')->insert($details);

            return response()->json(['code' => true, 'message' => 'Sukes Daftar Kursus', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function doNextRegisterCourse(Request $request) {
        try {
            $data = $request->all();

            if($data['bukti_pembayaran'] === 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg') {
                $data['bukti_pembayaran'] = '';
            }

            $rules = [
                'bukti_pembayaran' => 'required',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return response()->json(['code' => false, 'message' => $errors]);
            }

            $id_register_course = DB::table('register_course')->where('id_user', $data['id_user'])->pluck('id')->first();
         
            $details = [
                'id_register_course' => $id_register_course,
                'bukti_pembayaran' => isset($data['bukti_pembayaran']) ? $data['bukti_pembayaran'] : null,
                'kategori_kursus' => isset($data['kategori_kursus']) ? $data['kategori_kursus'] : null,
            ];

            DB::table('register_course_detail')->insert($details);

            return response()->json(['code' => true, 'message' => 'Sukes Daftar Kursus', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }
}