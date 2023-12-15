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
        $costume_type = DB::table('costume_type as ct')
            ->join('size as s', 's.id', 'ct.id_size')
            ->select('ct.id', 'ct.nama', 's.nama as nama_size', 'ct.ketegori_kostum')
            ->get();
        $size = DB::table('size')->get();
        return view('costume.type', compact('costume_type', 'size'));
    }

    public function customTypeDetail($id)
    {
        $costume_type = DB::table('costume_type')->where('id', $id)->first();

        $costume_type_details = DB::table('costume_type_details')->get();

        return view('costume.typeDetails', compact('costume_type', 'costume_type_details'));
    }

    public function addType(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'nama_custome' => 'required|string|max:50|unique:costume_type,nama',
                'id_size' => 'required|numeric',
                'ketegori_kostum' => 'required|string|max:2',
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
                'nama' => $data['nama_custome'],
                'id_size' => $data['id_size'],
                'ketegori_kostum' => $data['ketegori_kostum'],
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

    public function addTypeDetail(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'id_costume_type' => 'required|string|max:50',
                'image' => 'required|image|mimes:jpeg,jpg,png|dimensions:width=310,height=283',
                'kondisi' => 'required|string',
                'aksesoris' => 'required|string',
                'bahan' => 'required|string',
                'harga' => 'required|string',
                'denda_keterlambatan' => 'required|string',
                'jangka_waktu_sewa' => 'required|string',
                'stock' => 'required|string',
                'is_favorite' => 'required|boolean',
            ];
            
            $message = [
                'image.dimensions' => 'The :attribute must be a maximum of 310 pixels in width and 283 pixels in height.',
            ];
    
            $validator = Validator::make($data, $rules, $message);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::custom-type-detail', ['id' => $data['id_costume_type']])->with('error', $errors);
            }

            $url_image = '';
            if (isset($data['image']) != null || isset($data['image']) != '') {
                //Move Uploaded File to public folder
                $destinationPath = 'Custom_Type' . '/' . $data['id_costume_type'];
                $myimage = $data['image']->getClientOriginalName();
                $data['image']->move(public_path($destinationPath), $myimage);

                $url_image = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;
            }

            $insert = [
                'id_costume_type' => $data['id_costume_type'],
                'image' => $url_image,
                'kondisi' => $data['kondisi'],
                'aksesoris' => $data['aksesoris'],
                'bahan' => $data['bahan'],
                'harga' =>  (float) str_replace(['Rp', ',', '.'], '', $data['harga']),
                'denda_keterlambatan' =>  (float) str_replace(['Rp', ',', '.'], '', $data['denda_keterlambatan']),
                'jangka_waktu_sewa' =>  $data['jangka_waktu_sewa'],
                'stock' =>  $data['stock'],
                'is_favorite' => $data['is_favorite'],
            ];
         
            $size = DB::table('costume_type_details')->insert($insert);

            if($size == true) {
                return redirect()->route('admin::custom-type-detail', ['id' => $data['id_costume_type']])->with('success', 'Sukses Menambahkan Jenis Kustom');
            } else {
                return redirect()->route('admin::custom-type-detail', ['id' => $data['id_costume_type']])->with('error', 'Gagal Menambahkan Jenis Kustom');
            }

        } catch (Exception $e) {
            return redirect()->route('admin::custom-type-detail', ['id' => $data['id_costume_type']])->with('error', 'Gagal Menambahkan Jenis Kustom ' . $e->getMessage());
        }
    }

    public function editTypeDetail(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'id_costume_type' => 'required',
                'image' => 'nullable|image|mimes:jpeg,jpg,png|dimensions:width=310,height=283',
                'kondisi' => 'required|string',
                'aksesoris' => 'required|string',
                'bahan' => 'required|string',
                'harga' => 'required|string',
                'denda_keterlambatan' => 'required|string',
                'jangka_waktu_sewa' => 'required|string',
                'stock' => 'required|string',
                'is_favorite' => 'required|boolean',
            ],
            [
                'image.dimensions' => 'The :attribute must be a maximum of 310 pixels in width and 283 pixels in height.',
            ]);

            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }

                return redirect()->back()->with('error', $errors);
            }
    
            if (isset($data['image']) != null || isset($data['image']) != '') {
                $image_old = explode("/", $data['image_old']);

                $data_old = DB::table('costume_type_details')->where('id', $data['id'])->first();

                $filePath = public_path('Custom_Type' . '/' . $data_old->id_costume_type . '/' . end($image_old));

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                //Move Uploaded File to public folder
                $destinationPath = 'Custom_Type' . '/' . $data_old->id_costume_type;
                $myimage = $data['image']->getClientOriginalName();
                $data['image']->move(public_path($destinationPath), $myimage);

                $url_image = env('APP_URL') .'/'. $destinationPath . '/' . $myimage;

                $update = [
                    'id_costume_type' => $data['id_costume_type'],
                    'image' => $url_image,
                    'kondisi' => $data['kondisi'],
                    'aksesoris' => $data['aksesoris'],
                    'bahan' => $data['bahan'],
                    'harga' =>  (float) str_replace(['Rp', ',', '.'], '', $data['harga']),
                    'denda_keterlambatan' =>  (float) str_replace(['Rp', ',', '.'], '', $data['denda_keterlambatan']),
                    'jangka_waktu_sewa' =>  $data['jangka_waktu_sewa'],
                    'stock' =>  $data['stock'],
                    'is_favorite' => $data['is_favorite'],
                ];
             
                $kategori_materi = DB::table('costume_type_details')->where('id', intval($data['id']))->update($update);
            } else {

                $kategori_materi = DB::table('costume_type_details')->where('id', intval($data['id']))
                    ->update([
                        'id_costume_type' => $data['id_costume_type'],
                        'image' => $data['image_old'],
                        'kondisi' => $data['kondisi'],
                        'aksesoris' => $data['aksesoris'],
                        'bahan' => $data['bahan'],
                        'harga' =>  (float) str_replace(['Rp', ',', '.'], '', $data['harga']),
                        'denda_keterlambatan' =>  (float) str_replace(['Rp', ',', '.'], '', $data['denda_keterlambatan']),
                        'jangka_waktu_sewa' =>  $data['jangka_waktu_sewa'],
                        'stock' =>  $data['stock'],
                        'is_favorite' => $data['is_favorite'],
                    ]);
            }

            return redirect()->back()->with('success', 'Sukses Edit Jenis Kustom Details');

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteTypeDetail($id, $id_custome_type)
    {
        try {
            DB::table('costume_type_details')->where('id', $id)->delete();

            $costume_type = DB::table('costume_type')->where('id', $id_custome_type)->first();

            $costume_type_details = DB::table('costume_type_details')->get();

            return redirect()->route('admin::custom-type-detail', ['id' => $id_custome_type])->with('success', 'Berhasil Menghapus Jenis Kustom Detail');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal Menghapus Jenis Kustom Detail ' . $e->getMessage());
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

    public function indexTakingRentalCostume()
    {
        $trx_custome_rental = DB::table('trx_custome_rental as tcr')
                ->join('costume_type_details as ctd', 'ctd.id', 'tcr.id_costume_type_detail')
                ->join('costume_type as ct', 'ct.id', 'tcr.id_costume_type')
                ->join('users as u', 'u.id', 'tcr.id_user')
                ->select(
                    'ctd.image', 
                    'ct.nama', 
                    'tcr.quantity', 
                    'tcr.harga', 
                    'tcr.total_harga',
                    'tcr.status', 
                    'tcr.id as id_transaksi', 
                    'tcr.tgl_pengambilan', 
                    'tcr.tgl_pengembalian', 
                    'u.email',
                )
                ->where('tcr.status', 'DIPESAN')
                ->orderBy('tcr.id', 'DESC')
                ->get();

        return view('costume.takingRentalCustome', compact('trx_custome_rental'));
    }

    public function editTakingRentalCostume(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'status' => 'required|string',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::taking-rental-costume')->with('error', $errors);
            }

            $update = true;
            if($data['status'] === 'DIAMBIL') {
                $tcr = DB::table('trx_custome_rental')->where('id', $data['id_transaksi'])->first();
                $ctd = DB::table('costume_type_details')->where('id', $tcr->id_costume_type_detail)->first();

                if($tcr->quantity > $ctd->stock)
                {
                    return redirect()->route('admin::taking-rental-costume')->with('error', 'Stock Tidak Mencukupi');
                }

                $stock = (int) $ctd->stock - (int) $tcr->quantity;

                $record = [
                    'stock' => $stock
                ];

                DB::table('costume_type_details')->where('id', $tcr->id_costume_type_detail)->update($record);

                $record_1 = [
                    'status' => $data['status'],
                ];

                $update = DB::table('trx_custome_rental')->where('id', $data['id_transaksi'])->update($record_1);
            }

            if($data['status'] === 'DIBATALKAN') {
                $record_1 = [
                    'status' => $data['status'],
                ];

                $update = DB::table('trx_custome_rental')->where('id', $data['id_transaksi'])->update($record_1);
            }

            if($update == true) {
                return redirect()->route('admin::taking-rental-costume')->with('success', 'Sukses Merubah Pengambilan Kostum');
            } else {
                return redirect()->route('admin::taking-rental-costume')->with('error', 'Gagal Merubah Pengambilan Kostum');
            }

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function indexReturnRentalCostume()
    {
        $trx_custome_rental = DB::table('trx_custome_rental as tcr')
                ->join('costume_type_details as ctd', 'ctd.id', 'tcr.id_costume_type_detail')
                ->join('costume_type as ct', 'ct.id', 'tcr.id_costume_type')
                ->join('users as u', 'u.id', 'tcr.id_user')
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
                    'u.email',
                )
                ->where('tcr.status', 'DIBAYAR')
                ->orWhere('tcr.status', 'DIAMBIL')
                ->orderBy('tcr.id', 'DESC')
                ->get();

        return view('costume.returnRentalCustome', compact('trx_custome_rental'));
    }

    public function editReturnRentalCostume(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'status' => 'required|string',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::taking-rental-costume')->with('error', $errors);
            }

            $update = true;
            if($data['status'] === 'DISETUJUI') {
                $tcr = DB::table('trx_custome_rental')->where('id', $data['id_transaksi'])->first();
                $ctd = DB::table('costume_type_details')->where('id', $tcr->id_costume_type_detail)->first();

                if($tcr->quantity > $ctd->stock)
                {
                    return redirect()->route('admin::taking-rental-costume')->with('error', 'Stock Tidak Mencukupi');
                }

                $stock = (int) $ctd->stock + (int) $tcr->quantity;

                $record = [
                    'stock' => $stock
                ];

                DB::table('costume_type_details')->where('id', $tcr->id_costume_type_detail)->update($record);

                $record_1 = [
                    'status' => $data['status'],
                    'tgl_disetujui' => date("Y-m-d H:i:s"),
                ];

                $update = DB::table('trx_custome_rental')->where('id', $data['id_transaksi'])->update($record_1);
            }

            if($update == true) {
                return redirect()->route('admin::return-rental-costume')->with('success', 'Sukses Merubah Pengembalian Kostum');
            } else {
                return redirect()->route('admin::return-rental-costume')->with('error', 'Gagal Merubah Pengembalian Kostum');
            }

        } catch (Exception $e) {
            return redirect()->route('admin::return-rental-costume')->with('error', 'Gagal Merubah Pengembalian Kostum ' . $e->getMessage());
        }
    }

    public function indexListRentalCostume()
    {
        $trx_custome_rental = DB::table('trx_custome_rental as tcr')
            ->join('costume_type_details as ctd', 'ctd.id', 'tcr.id_costume_type_detail')
            ->join('costume_type as ct', 'ct.id', 'tcr.id_costume_type')
            ->join('users as u', 'u.id', 'tcr.id_user')
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
                'tcr.tgl_pengambilan', 
                'tcr.tgl_pengembalian', 
                'u.email',
            )
            ->orderBy('tcr.id', 'DESC')
            ->get();

        return view('costume.listRentalCustome', compact('trx_custome_rental')); 
    }
}