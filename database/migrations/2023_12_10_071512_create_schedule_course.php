<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kategori_kursus', 30)->nullable();
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->string('lokasi', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_course');
    }
}