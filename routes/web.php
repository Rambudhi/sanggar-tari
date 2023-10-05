<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\General\HomeController;
use App\Http\Controllers\Web\General\ClassController;
use App\Http\Controllers\Web\General\CostumeRentalController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Admin\ClassController as Admin_ClassController;
use App\Http\Controllers\Web\Admin\CostumeController as Admin_CostumeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'formLogin'])->name('form-login');
Route::post('/do-login', [LoginController::class, 'doLogin'])->name('do-login');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['checkSession'])->group(function () {
    // Routes that require session check
    Route::get('/register', [RegisterController::class, 'formRegister'])->name('form-register');
    Route::get('/register-course', [RegisterController::class, 'formRegisterCourse'])->name('form-register-course');
    Route::post('/do-register', [RegisterController::class, 'doRegister'])->name('do-register');
    Route::post('/do-insert-register-course', [RegisterController::class, 'doInsertRegisterCourse'])->name('do-insert-register-course');
    Route::post('/do-next-register-course', [RegisterController::class, 'doNextRegisterCourse'])->name('do-next-register-course');
    Route::post('/upload-photo', [RegisterController::class, 'uploadPhoto'])->name('upload-photo');
    Route::post('/upload-kk', [RegisterController::class, 'uploadKK'])->name('upload-kk');
    Route::post('/upload-bp', [RegisterController::class, 'uploadBuktiPembayaran'])->name('upload-bp');

    Route::get('/kelas/{kategori}', [ClassController::class, 'index'])->name('class');
    Route::get('/kelas/{kategori}/{id}', [ClassController::class, 'indexDetail'])->name('class-video');

    Route::get('/penyewaan-kostum-purnama', [CostumeRentalController::class, 'index'])->name('costume-rental');
    Route::get('/penyewaan-kostum-purnama/{id}', [CostumeRentalController::class, 'indexCustomeRental'])->name('costume-rental-by-custome');
    Route::get('/list-penyewaan-kostum-purnama', [CostumeRentalController::class, 'ListCustomeRental'])->name('list-costume-rental');
    Route::post('/penyewaan-kostum-purnama/add', [CostumeRentalController::class, 'addCustomeRental'])->name('add-costume-rental-by-custome');

    Route::get('/list-pengembalian-kostum-purnama', [CostumeRentalController::class, 'listReturnCustomeRental'])->name('list-return-costume-rental');
    Route::post('/pengembalian-kostum-purnama/add', [CostumeRentalController::class, 'addReturnCustomeRental'])->name('add-return-costume-rental-by-custome');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin::dashboard');
        Route::get('/user-active', [UserController::class, 'userActive'])->name('admin::user-active');
        Route::post('/verified-course', [UserController::class, 'verifiedCourse'])->name('admin::verified-course');

        Route::get('/register-course', [UserController::class, 'registerCourse'])->name('admin::register-course');
        Route::post('/edit-register-course', [UserController::class, 'editRegisterCourse'])->name('admin::edit-register-course');
        Route::get('/delete-register-course/{id}/{id_user}', [UserController::class, 'deleteRegisterCourse'])->name('admin::delete-register-course');
        Route::get('/register-course-detail/{id}', [UserController::class, 'registerCourseDetail'])->name('admin::register-course-detail');

        Route::get('/class-material', [Admin_ClassController::class, 'index'])->name('admin::class-material');
        Route::get('/class-material-detail/{id}', [Admin_ClassController::class, 'indexDetail'])->name('admin::class-material-detail');

        Route::get('/delete-class-material-detail/{id}/{id_materi}', [Admin_ClassController::class, 'deleteMateriVideo'])->name('admin::delete-class-material-detail');
        
        Route::post('/add-materi-kursus', [Admin_ClassController::class, 'addMateriKursus'])->name('admin::add-materi-kursus');
        Route::post('/edit-materi-kursus', [Admin_ClassController::class, 'editMateriKursus'])->name('admin::edit-materi-kursus');
        Route::get('/delete-class-material/{id}', [Admin_ClassController::class, 'deleteMateriKursus'])->name('admin::delete-class-material');

        Route::post('/add-materi-video', [Admin_ClassController::class, 'addMateriVideo'])->name('admin::add-materi-video');


        Route::get('/custom-size', [Admin_CostumeController::class, 'size'])->name('admin::custom-size');
        Route::post('/custom-size/add', [Admin_CostumeController::class, 'addSize'])->name('admin::add-custom-size');
        Route::post('/custom-size/edit', [Admin_CostumeController::class, 'editSize'])->name('admin::edit-custom-size');

        Route::get('/custom-type', [Admin_CostumeController::class, 'customType'])->name('admin::custom-type');
        Route::post('/custom-type/add', [Admin_CostumeController::class, 'addType'])->name('admin::add-custom-type');
        Route::get('/custom-type-detail/{id}', [Admin_CostumeController::class, 'customTypeDetail'])->name('admin::custom-type-detail');
        Route::post('/custom-type-detail/add', [Admin_CostumeController::class, 'addTypeDetail'])->name('admin::custom-type-detail-add');
        Route::post('/custom-type-detail/edit', [Admin_CostumeController::class, 'editTypeDetail'])->name('admin::custom-type-detail-edit');
        Route::get('/custom-type-detail-delete/{id}/{id_custome_type}', [Admin_CostumeController::class, 'deleteTypeDetail'])->name('admin::custom-type-detail-delete');

        Route::get('/taking-rental-costume', [Admin_CostumeController::class, 'indexTakingRentalCostume'])->name('admin::taking-rental-costume');
        Route::post('/taking-rental-costume/edit', [Admin_CostumeController::class, 'editTakingRentalCostume'])->name('admin::edit-taking-rental-costume');

        Route::get('/return-rental-costume', [Admin_CostumeController::class, 'indexReturnRentalCostume'])->name('admin::return-rental-costume');
        Route::post('/return-rental-costume/edit', [Admin_CostumeController::class, 'editReturnRentalCostume'])->name('admin::edit-return-rental-costume');

        Route::get('/list-rental-costume', [Admin_CostumeController::class, 'indexListRentalCostume'])->name('admin::list-rental-costume');
    });
});
