<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisasiTable extends Migration
{
    public function up()
    {
        Schema::create('organisasi', function (Blueprint $table) {
            $table->id(); // Primary key auto-increment
            $table->string('nim'); // NIM mahasiswa
            $table->string('nama'); // Nama mahasiswa
            $table->string('id_organisasi'); // ID kegiatan (tanpa relasi foreign key)
            $table->string('nama_organisasi'); // Nama organisasi
            $table->string('absensi'); // Jumlah absensi
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('organisasi');
    }
}
