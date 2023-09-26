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

    public function registerCourseDetail($id)
    {
        $register_course_detail = DB::table('register_course_detail')->where('id_register_course', $id)->paginate();

         return view('register_course.listDetail', compact('register_course_detail'));
    }

    public function verifiedCourse(Request $request)
    {
        $update = DB::table('register_course_detail')->where('id', $request->id)->update(['is_verified' => 1]);

        return response()->json(['code' => true, 'message' => 'Sukes Verifikasi']);
    }

    public function editRegisterCourse(Request $request) {
        try {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'nama_depan' => 'required|string|unique:register_course,nama_depan,'.$request->id,
                'nama_belakang' => 'required|string|unique:register_course,nama_belakang,'.$request->id,
                'pendidikan' => 'required|string|unique:register_course,pendidikan,'.$request->id,
                'nomor_telepon' => 'required|string|unique:register_course,nomor_telepon,'.$request->id,
                'nama_ortu' => 'nullable|string|unique:register_course,nama_ortu,'.$request->id,
                'nomor_telepon_ortu' => 'nullable|string|unique:register_course,nomor_telepon_ortu,'.$request->id,
                'pekerjaan_ortu' => 'nullable|string|unique:register_course,pekerjaan_ortu,'.$request->id,
                'photo_file' => 'nullable|image|mimes:jpeg,jpg,png',
                'kk_file' => 'nullable|image|mimes:jpeg,jpg,png',
                'alamat' => 'required',
                'kota' => 'required|string|unique:register_course,provinsi,'.$request->id,
                'provinsi' => 'required|string|unique:register_course,provinsi,'.$request->id,
                'kode_pos' => 'required|string|unique:register_course,kode_pos,'.$request->id,
            ]);

            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }

                return redirect()->back()->with('error', $errors);
            }

            $data_old = DB::table('register_course')->where('id', $data['id'])->first();

            $url_photo = '';
            $url_kk = '';

            if (isset($data['photo_file']) != null || isset($data['photo_file']) != '') {
                $image_old = explode("/", $data['photo_old']);

                $filePath = public_path('PHOTO' .'/'. end($image_old));

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                //Move Uploaded File to public folder
                $destinationPath = 'PHOTO';
                $myimage = $data['photo_file']->getClientOriginalName();
                $data['photo_file']->move(public_path($destinationPath), $myimage);

                $url_photo = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;
            }

            if (isset($data['kk_file']) != null || isset($data['kk_file']) != '') {
                $kk_old = explode("/", $data['kk_old']);

                $filePath = public_path('KK' . '/' . end($kk_old));

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                //Move Uploaded File to public folder
                $destinationPath = 'PHOTO';
                $myimage = $data['kk_file']->getClientOriginalName();
                $data['kk_file']->move(public_path($destinationPath), $myimage);

                $url_kk = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;
            }

            $update = [
                'id_user' => $data['id_user'],
                'nama_depan' => $data['nama_depan'],
                'pendidikan' => isset($data['pendidikan']) ? $data['pendidikan'] : null,
                'nama_belakang' => $data['nama_belakang'],
                'nomor_telepon' => isset($data['nomor_telepon']) ? $data['nomor_telepon'] : null,
                'photo' => $url_photo == '' ? $data_old->photo : $url_photo,
                'kartu_keluarga' => $url_kk == '' ? $data_old->kartu_keluarga : $url_kk,
                'nama_ortu' => isset($data['nama_ortu']) ? $data['nama_ortu'] : null,
                'nomor_telepon_ortu' => isset($data['nomor_telepon_ortu']) ? $data['nomor_telepon_ortu'] : null,
                'pekerjaan_ortu' => isset($data['pekerjaan_ortu']) ? $data['pekerjaan_ortu'] : null,
                'alamat' => isset($data['alamat']) ? $data['alamat'] : null,
                'kota' => isset($data['kota']) ? $data['kota'] : null,
                'provinsi' => isset($data['provinsi']) ? $data['provinsi'] : null,
                'kode_pos' => isset($data['kode_pos']) ? $data['kode_pos'] : null,
            ];
         
            DB::table('register_course')->where('id', $data['id'])->update($update);

            return redirect()->back()->with('success', 'Sukses Edit Data Register Kursus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal  Edit Data Register Kursus ' . $e->getMessage());
        }
    }
}
