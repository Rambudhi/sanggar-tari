<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostumeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costume_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
            $table->index('id_size');
            $table->integer('id_size')->unsigned()->nullable();
            $table->foreign('id_size')->references('id')->on('size');
            $table->char('ketegori_kostum', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costume_type');
    }
}
