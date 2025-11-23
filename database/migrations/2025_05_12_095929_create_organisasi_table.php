<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organisasis', function (Blueprint $table) {
            $table->id();
            $table->string('id_organisasi')->unique();  // WAJIB UNIQUE AGAR BISA JADI FOREIGN KEY
            $table->string('nama_organisasi');
            $table->unsignedBigInteger('id_kegiatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organisasis');
    }
};
