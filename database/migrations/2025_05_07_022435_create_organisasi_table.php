<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->unsignedBigInteger('id_kegiatan');
            $table->string('nama_kegiatan');
            $table->string('absensi');
            $table->timestamps();

            $table->foreign('id_kegiatan')
                ->references('id')
                ->on('kegiatans')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organisasi');
    }
};
