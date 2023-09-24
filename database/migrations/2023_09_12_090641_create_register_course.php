<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_course', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id_user');
            $table->integer('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('nama_depan', 30);
            $table->string('nama_belakang', 30);
            $table->text('photo')->nullable();
            $table->text('kartu_keluarga')->nullable();
            $table->string('pendidikan', 20);
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('nama_ortu', 30)->nullable();
            $table->string('nomor_telepon_ortu', 30)->nullable();
            $table->string('pekerjaan_ortu', 30)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kota', 30)->nullable();
            $table->string('provinsi', 30)->nullable();
            $table->string('kode_pos', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_course');
    }
}
