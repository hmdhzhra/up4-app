<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengujian_id');
            $table->string('tim_lab');
            $table->string('surat_tugas', 150)->nullable();
            $table->string('laporan_lab', 150)->nullable();
            $table->timestamps();

            $table->foreign('pengujian_id')->references('id')->on('pengujian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penugasan');
    }
}
