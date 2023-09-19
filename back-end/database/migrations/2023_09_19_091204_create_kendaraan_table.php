<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kendaraan', function (Blueprint $table) {
            $table->id("id_kendaraan");
            $table->string("nama_kendaraan");
            $table->string("kilometer_kendaraan");
            $table->enum("jenis_angkutan_kendaraan", ['barang', 'orang']);
            $table->enum("pemilik_kendaraan", ['perusahaan', 'sewaan']);
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
        Schema::dropIfExists('tb_kendaraan');
    }
};
