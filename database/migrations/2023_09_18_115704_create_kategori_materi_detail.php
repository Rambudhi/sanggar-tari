<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriMateriDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_materi_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kategori_kursus');
            $table->string('nama', 30);
            $table->text('video');
            $table->text('desc');
            $table->integer('order_seq')->unique();
            $table->text('image');
            $table->string('deskripsi_image', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_materi_detail');
    }
}