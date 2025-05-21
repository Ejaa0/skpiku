<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('skpis', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('ttl');
        $table->string('nim')->unique();
        $table->string('masuk');
        $table->string('lulus');
        $table->string('no_ijazah');
        $table->string('gelar');
        $table->string('prodi');
        $table->string('bahasa');
        $table->string('jenjang');
        $table->string('karakter');
        $table->string('tanggal_surat');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skpis');
    }
};
