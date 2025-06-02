<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKegiatanMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('detail_kegiatan_mahasiswa', function (Blueprint $table) {
            $table->id();

            $table->string('mahasiswa_nim', 15);
            $table->foreign('mahasiswa_nim')
                ->references('nim')->on('mahasiswas')
                ->onDelete('cascade');

            $table->unsignedBigInteger('kegiatan_id_ref');
            $table->foreign('kegiatan_id_ref')
                ->references('id')->on('kegiatans')
                ->onDelete('cascade');

            $table->timestamps();

            // Unique supaya satu mahasiswa hanya bisa ikut 1 kegiatan sekali saja
            $table->unique(['mahasiswa_nim', 'kegiatan_id_ref'], 'mahasiswa_kegiatan_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_kegiatan_mahasiswa');
    }
}
