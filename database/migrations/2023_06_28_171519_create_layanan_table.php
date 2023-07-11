<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengujian_id');
            $table->unsignedBigInteger('jenis_id');
            $table->integer('jumlah');
            $table->bigInteger('total');
            $table->enum('status_pembayaran',['unpaid','paid']);
            $table->timestamps();

            $table->foreign('jenis_id')->references('id')->on('jenis_layanan')->onDelete('cascade');
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
        Schema::dropIfExists('layanan');
    }
}
