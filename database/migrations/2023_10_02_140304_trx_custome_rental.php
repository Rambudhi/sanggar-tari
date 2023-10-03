<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrxCustomeRental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_custome_rental', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->index('id_costume_type');
            $table->integer('id_costume_type')->unsigned()->nullable();
            $table->foreign('id_costume_type')->references('id')->on('costume_type');
            $table->index('id_costume_type_detail');
            $table->integer('id_costume_type_detail')->unsigned()->nullable();
            $table->foreign('id_costume_type_detail')->references('id')->on('costume_type_details');
            $table->integer('quantity');
            $table->integer('harga');
            $table->decimal('total_harga', 15, 2);
            $table->char('status', 15);
            $table->timestamp('tgl_pembayaran')->nullable();
            $table->text('bukti_pembayaran')->nullable();
            $table->timestamp('tgl_pengambilan')->nullable();
            $table->timestamp('tgl_pengembalian')->nullable();
            $table->timestamp('tgl_disetujui')->nullable();
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
