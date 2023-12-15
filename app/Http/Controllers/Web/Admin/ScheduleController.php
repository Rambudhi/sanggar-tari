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

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule_course = DB::table('schedule_course')->get();
        return view('schedule_course.index', compact('schedule_course'));
    }

    public function addScheduleCourse(Request $request)
    {
        try {
            $data = $request->all();

            $rules = [
                'kategori_kursus' => 'required',
                'tanggal' => 'required',
                'jam' => 'required',
                'lokasi' => 'required',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::schedule-course-by-category')->with('error', $errors);
            }

            $insert = [
                'kategori_kursus' => $data['kategori_kursus'],
                'tanggal' => $data['tanggal'],
                'jam' => $data['jam'],
                'lokasi' => $data['lokasi'],
            ];
         
            $size = DB::table('schedule_course')->insert($insert);

            if($size == true) {
                return redirect()->route('admin::schedule-course-by-category')->with('success', 'Sukses Menambahkan Jadwal Kursus');
            } else {
                return redirect()->route('admin::schedule-course-by-category')->with('error', 'Gagal Menambahkan Jadwal Kursus');
            }

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function editScheduleCourse(Request $request)
    {
        try {
            $data = $request->all();
            
            $rules = [
                'kategori_kursus' => 'required',
                'tanggal' => 'required',
                'jam' => 'required',
                'lokasi' => 'required',
            ];
    
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                $errors = '';
                foreach($validator->messages()->messages() as $error) {
                    $errors .= str_replace('.', '', $error[0] . ', ');
                }
    
                return redirect()->route('admin::schedule-course-by-category')->with('error', $errors);
            }

            $insert = [
                'kategori_kursus' => $data['kategori_kursus'],
                'tanggal' => $data['tanggal'],
                'jam' => $data['jam'],
                'lokasi' => $data['lokasi'],
            ];
         
            $schedule_course = DB::table('schedule_course')->where('id', $data['id'])->update($insert);

            if($schedule_course == true) {
                return redirect()->route('admin::schedule-course-by-category')->with('success', 'Sukses Menambahkan Jadwal Kursus');
            } else {
                return redirect()->route('admin::schedule-course-by-category')->with('error', 'Gagal Menambahkan Jadwal Kursus');
            }

        } catch (Exception $e) {
            return response()->json(['code' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteScheduleCourse($id)
    {
        try {
            DB::table('schedule_course')->where('id', $id)->delete();

            return redirect()->route('admin::schedule-course-by-category')->with('success', 'Berhasil Menghapus Jadwal Kursus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal Menghapus Jadwal Kursus' . $e->getMessage());
        }
    }
}