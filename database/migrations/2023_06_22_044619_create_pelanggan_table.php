<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->unsigned();
            $table->string('nama_lengkap', 100);
            $table->string('nik', 16);
            $table->string('telp', 14);
            $table->string('jabatan', 150);
            $table->text('alamat');
            $table->string('nama_pr', 150);
            $table->string('email_pr', 150);
            $table->string('alamat_pr', 150);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
}
