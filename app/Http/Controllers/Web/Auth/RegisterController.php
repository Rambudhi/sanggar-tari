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
            return view('register_course.index');
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
                'kartu_keluarga' => isset($data['kartu_keluarga']) ? $data['kartu_keluarga'] : null,
                'bukti_pembayaran' => isset($data['bukti_pembayaran']) ? $data['bukti_pembayaran'] : null,
                'kategori_kursus' => isset($data['kategori_kursus']) ? $data['kategori_kursus'] : null,
                'alamat' => isset($data['alamat']) ? $data['alamat'] : null,
                'kota' => isset($data['kota']) ? $data['kota'] : null,
                'provinsi' => isset($data['provinsi']) ? $data['provinsi'] : null,
                'kode_pos' => isset($data['kode_pos']) ? $data['kode_pos'] : null,
            ];
         
            DB::table('register_course')->insert($insert);

            return response()->json(['code' => true, 'message' => 'Sukes Daftar Kursus', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }
}
