<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengujianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengujian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggan_id');
            $table->string('nama_proyek', 150);
            $table->string('lokasi_proyek', 150);
            $table->string('bidang', 150);
            $table->string('berkas_sp', 150);
            $table->string('berkas_spmk', 150)->nullable();
            $table->string('berkas_ktp', 150);
            $table->string('berkas_gambar', 150)->nullable();
            $table->string('berkas_skrd', 150)->nullable();
            $table->string('status', 100);
            $table->date('tgl_permohonan');
            $table->date('jadwal_pengujian')->nullable();
            $table->string('no_skrd',100)->nullable();
            $table->string('no_order',100)->nullable();
            $table->string('laporan', 150)->nullable();
            $table->string('keterangan', 250)->nullable();
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengujian');
    }
}
