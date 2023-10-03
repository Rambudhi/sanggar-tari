<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomeTypeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costume_type_details', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id_costume_type');
            $table->integer('id_costume_type')->unsigned()->nullable();
            $table->foreign('id_costume_type')->references('id')->on('costume_type');
            $table->text('image');
            $table->string('kondisi', 50);
            $table->string('aksesoris', 50);
            $table->string('bahan', 50);
            $table->decimal('harga', 15, 2);
            $table->decimal('denda_keterlambatan', 15, 2);
            $table->integer('jangka_waktu_sewa');
            $table->integer('stock');
            $table->boolean('is_favorite')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
