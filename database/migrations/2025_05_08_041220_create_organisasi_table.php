<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisasiTable extends Migration
{
    public function up()
    {
        Schema::create('organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->unsignedBigInteger('id_kegiatan');
            $table->string('nama_organisasi');
            $table->string('absensi');
            $table->timestamps();

            $table->foreign('id_kegiatan')->references('id')->on('kegiatans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organisasi');
    }
}
