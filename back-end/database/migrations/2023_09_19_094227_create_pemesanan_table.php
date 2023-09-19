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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id("id_pemesanan");
            $table->string("driver");
            $table->enum("persetujuan_admin", ['setuju', 'tidak_setuju']);
            $table->enum("persetujuan_pihak", ['setuju', 'tidak_setuju']);
            $table->unsignedBigInteger("id_user");
            $table->unsignedBigInteger("id_kendaraan");
            $table->timestamps();
        });
        Schema::table('pemesanan', function ($table) {
            $table->foreign("id_user")->references("id_user")->on("user")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("id_kendaraan")->references("id_kendaraan")->on("kendaraan")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
};
