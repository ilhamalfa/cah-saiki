<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelanggan');
            $table->foreignId('id_pegawai')->nullable();
            $table->integer('total');
            $table->string('status');
            $table->string('kode');
            $table->integer('cash_in')->nullable();
            $table->integer('cash_out')->nullable();
            $table->timestamp('tanggal');
            $table->timestamp('expired')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
