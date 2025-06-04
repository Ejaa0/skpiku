<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailOrganisasiMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('detail_organisasi_mahasiswa', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel mahasiswas
            $table->string('mahasiswa_nim', 15);
            $table->foreign('mahasiswa_nim')
                ->references('nim')->on('mahasiswas')
                ->onDelete('cascade');

            // Foreign key ke tabel organisasis
            $table->string('organisasi_id_ref');
            $table->foreign('organisasi_id_ref')
                ->references('id_organisasi')->on('organisasis')
                ->onDelete('cascade');

            $table->string('jabatan')->nullable();              // Jabatan dalam organisasi
            $table->string('status_keanggotaan')->nullable();   // Aktif, Alumni, dll
            $table->timestamps();

            // Supaya satu mahasiswa tidak masuk dua kali ke organisasi yang sama
            $table->unique(['mahasiswa_nim', 'organisasi_id_ref'], 'mahasiswa_organisasi_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_organisasi_mahasiswa');
    }
}
