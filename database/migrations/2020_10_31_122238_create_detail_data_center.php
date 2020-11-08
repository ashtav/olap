<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDataCenter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_data_center', function (Blueprint $table) {
            $table->id();
            $table->string('data_id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('asal_sekolah');
            $table->string('pekerjaan_orang_tua');
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
        Schema::dropIfExists('detail_data_center');
    }
}
