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

class CostumeController extends Controller
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

    public function size()
    {
        $size = DB::table('size')->get();
        return view('costume.size', compact('size'));
    }

    public function addSize(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'nama_size' => 'required|string|max:50|unique:size,nama',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::custom-size')->with('error', $errors);
            }

            $insert = [
                'nama' => $data['nama_size'],
            ];
         
            $size = DB::table('size')->insert($insert);

            if($size == true) {
                return redirect()->route('admin::custom-size')->with('success', 'Sukses Menambahkan Ukuran');
            } else {
                return redirect()->route('admin::custom-size')->with('error', 'Gagal Menambahkan Ukuran');
            }

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function editSize()
    {
        try {
            $data = $request->all();

            $rules = [
                'nama' => 'required|string|max:50|unique:size,nama',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::custom-size')->with('error', $errors);
            }

            $insert = [
                'nama' => $data['nama'],
            ];
         
            $size = DB::table('size')->insert($insert);

            if($size == true) {
                return redirect()->route('admin::custom-size')->with('success', 'Sukses Menambahkan Materi Kursus');
            } else {
                return redirect()->route('admin::custom-size')->with('error', 'Gagal Menambahkan Materi Kursus');
            }

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function customType()
    {
        $costume_type = DB::table('costume_type')->get();
        return view('costume.type', compact('costume_type'));
    }

    public function addType(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'nama_size' => 'required|string|max:50|unique:size,nama',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::custom-type')->with('error', $errors);
            }

            $insert = [
                'nama' => $data['nama_size'],
            ];
         
            $size = DB::table('costume_type')->insert($insert);

            if($size == true) {
                return redirect()->route('admin::custom-type')->with('success', 'Sukses Menambahkan Jenis Kustom');
            } else {
                return redirect()->route('admin::custom-type')->with('error', 'Gagal Menambahkan Jenis Kustom');
            }

        } catch (Exception $e) {
            return redirect()->route('admin::custom-type')->with('error', 'Gagal Menambahkan Jenis Kustom ' . $e->getMessage());
        }
    }

    public function editType()
    {
        try {
            $data = $request->all();

            $rules = [
                'nama' => 'required|string|max:50|unique:size,nama',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::custom-size')->with('error', $errors);
            }

            $insert = [
                'nama' => $data['nama'],
            ];
         
            $size = DB::table('size')->insert($insert);

            if($size == true) {
                return redirect()->route('admin::custom-size')->with('success', 'Sukses Menambahkan Materi Kursus');
            } else {
                return redirect()->route('admin::custom-size')->with('error', 'Gagal Menambahkan Materi Kursus');
            }

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }
}
