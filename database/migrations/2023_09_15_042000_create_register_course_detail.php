<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterCourseDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_course_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id_register_course');
            $table->integer('id_register_course')->unsigned()->nullable();
            $table->foreign('id_register_course')->references('id')->on('register_course');
            $table->string('kategori_kursus', 30)->nullable();
            $table->text('bukti_pembayaran')->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('is_verified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_course_detail');
    }
}
