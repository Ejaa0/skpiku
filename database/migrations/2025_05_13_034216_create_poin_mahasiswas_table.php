<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('poin_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->enum('tipe', ['kegiatan', 'organisasi']); // <- penanda asal poin
            $table->string('nama_kegiatan')->nullable();       // jika tipe = kegiatan
            $table->string('jenis_kegiatan')->nullable();      // jika tipe = kegiatan
            $table->date('tanggal_kegiatan')->nullable();      // jika tipe = kegiatan
            $table->string('jabatan')->nullable();             // jika tipe = organisasi
            $table->string('status_keanggotaan')->nullable();  // jika tipe = organisasi
            $table->text('deskripsi')->nullable();
            $table->integer('poin');                           // 100 atau 250
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poin_mahasiswas');
    }
};
