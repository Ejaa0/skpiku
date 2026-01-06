<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temans', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_nim'); // NIM pemilik teman
            $table->string('teman_nim');     // NIM teman yang ditambahkan
            $table->timestamps();

            $table->foreign('mahasiswa_nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('teman_nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->unique(['mahasiswa_nim', 'teman_nim']); // cegah duplikat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temans');
    }
};

