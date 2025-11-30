<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id_laporan');
            $table->bigInteger('id_reservasi'); 
            $table->string('id_order')->nullable();
            $table->date('tanggal_reservasi');
            $table->string('ruangan');
            $table->time('waktu_mulai');
            $table->time('waktu_akhir');
            $table->string('tipe_reservasi');
            $table->string('status');
            $table->string('payment_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
