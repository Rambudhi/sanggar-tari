<?php

namespace App\Http\Controllers\Web\Admin;

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

class ClassController extends Controller
{
    public function index()
    {
        $kategori_materi = DB::table('kategori_materi')->paginate();

         return view('class.index', compact('kategori_materi'));
    }

    public function indexDetail($id)
    {
        $kategori_materi = DB::table('kategori_materi')->where('id', $id)->first();
        $kategori_materi_detail = DB::table('kategori_materi_detail')->paginate();

         return view('class.indexDetail', compact('kategori_materi', 'kategori_materi_detail','id'));
    }

    public function addMateriKursus(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'kategori_kursus' => 'required',
                'nama_materi' => 'required|string|max:30|unique:kategori_materi,nama_materi',
                'image_materi' => 'required|image|mimes:jpeg,jpg,png',
                'order_seq' => 'required|numeric|unique:kategori_materi,order_seq',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::class-material')->with('error', $errors);
            }

            //Move Uploaded File to public folder
            $destinationPath = ucfirst($data['kategori_kursus']) . '/' . $data['nama_materi'];
            $myimage = $data['image_materi']->getClientOriginalName();
            $data['image_materi']->move(public_path($destinationPath), $myimage);

            $url_image = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;

            $insert = [
                'kategori_kursus' => $data['kategori_kursus'],
                'nama_materi' => $data['nama_materi'],
                'image_materi' => $url_image,
                'order_seq' => $data['order_seq']
            ];
         
            $kategori_materi = DB::table('kategori_materi')->insert($insert);

            if($kategori_materi == true) {
                return redirect()->route('admin::class-material')->with('success', 'Sukses Menambahkan Materi Kursus');
            } else {
                return redirect()->route('admin::class-material')->with('error', 'Gagal Menambahkan Materi Kursus');
            }

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function editMateriKursus(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'kategori_kursus' => 'required',
                'nama_materi' => 'required|string|max:30|unique:kategori_materi,nama_materi,'.$request->id,
                'image_materi' => 'nullable|image|mimes:jpeg,jpg,png',
                'order_seq' => 'required|numeric|unique:kategori_materi,order_seq,'.$request->id,
            ]);

            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }

                return redirect()->back()->with('error', $errors);
            }
    
            if (isset($data['image_materi']) != null || isset($data['image_materi']) != '') {
                $image_old = explode("/", $data['image_old']);

                $data_old = DB::table('kategori_materi')->where('id', $data['id'])->first();

                $filePath = public_path(ucfirst($data_old->kategori_kursus) . '/' . $data_old->nama_materi . '/' . end($image_old));

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                //Move Uploaded File to public folder
                $destinationPath = ucfirst($data['kategori_kursus']) . '/' . $data['nama_materi'];
                $myimage = $data['image_materi']->getClientOriginalName();
                $data['image_materi']->move(public_path($destinationPath), $myimage);

                $url_image = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;

                $update = [
                    'kategori_kursus' => $data['kategori_kursus'],
                    'nama_materi' => $data['nama_materi'],
                    'image_materi' => $url_image,
                    'order_seq' => intval($data['order_seq'])
                ];
             
                $kategori_materi = DB::table('kategori_materi')->where('id', intval($data['id']))->update($update);
            } else {

                $kategori_materi = DB::table('kategori_materi')->where('id', intval($data['id']))
                    ->update([
                        'kategori_kursus' => $data['kategori_kursus'],
                        'nama_materi' => $data['nama_materi'],
                        'image_materi' => $data['image_old'],
                        'order_seq' => intval($data['order_seq'])
                    ]);
            }

            return redirect()->back()->with('success', 'Sukses Edit Materi Kurus');

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function addMateriVideo(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'id_kategori_kursus' => 'required|numeric',
                'nama' => 'required|string|max:30|unique:kategori_materi_detail,nama',
                'video' => 'required|mimes:mp4,avi,mov,wmv|max:204800',
                'desc' => 'required|string',
                'order_seq' => 'required|numeric|unique:kategori_materi_detail,order_seq',
                'image' => 'required|image|mimes:jpeg,jpg,png',
                'deskripsi_image' => 'required|string',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::class-material-detail', ['id' => $data['id_kategori_kursus']])->with('error', $errors);
            }

            //Move Uploaded File to public folder
            $destinationPath = 'Video' . '/' . $data['id_kategori_kursus'] . '/' . ucfirst($data['nama']);
            $myVideo = $request->file('video')->getClientOriginalName();
            $data['video']->move(public_path($destinationPath), $myVideo);

            $destinationPath = 'Image' . '/' . $data['id_kategori_kursus'] . '/' . ucfirst($data['nama']);
            $myImage = $request->file('image')->getClientOriginalName();
            $data['image']->move(public_path($destinationPath), $myImage);

            $url_video = env('APP_URL') .'/'. $destinationPath . '/' . $myVideo;

            $url_image = env('APP_URL') .'/'. $destinationPath . '/' . $myImage;

            $insert = [
                'id_kategori_kursus' => $data['id_kategori_kursus'],
                'nama' => $data['nama'],
                'video' => $url_video,
                'desc' => $data['desc'],
                'order_seq' => $data['order_seq'],
                'image' => $url_image,
                'deskripsi_image' => $data['deskripsi_image'],
            ];
         
            $kategori_materi_detail = DB::table('kategori_materi_detail')->insert($insert);

            if($kategori_materi_detail == true) {
                return redirect()->route('admin::class-material-detail', ['id' => $data['id_kategori_kursus']])->with('success', 'Sukses Menambahkan Materi Kurus');
            } else {
                return redirect()->route('admin::class-material-detail', ['id' => $data['id_kategori_kursus']])->with('error', 'Gagal Menambahkan Materi Kurus');
            }

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteMateriKursus($id)
    {
        try {
            $record = DB::table('kategori_materi_detail')->where('id_kategori_kursus', $id)->first();

            if($record !== null) {
                return redirect()->route('admin::class-material')->with('error', 'Gafal Menghapus Materi, Mohon Hapus pertama Video Materi');
            } else {
                DB::table('kategori_materi')->where('id', $id)->delete();

                return redirect()->route('admin::class-material')->with('success', 'Berhasil Menghapus Materi');
            }
        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteMateriVideo($id, $id_materi)
    {
        try {
            DB::table('kategori_materi_detail')->where('id', $id)->delete();

            return redirect()->route('admin::class-material-detail', ['id' => $id_materi])->with('success', 'Berhasil Menghapus Video Materi');

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }
}