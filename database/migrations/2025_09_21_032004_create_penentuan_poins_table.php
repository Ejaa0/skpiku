<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penentuan_poin', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan'); // misal: "Mengikuti lomba debat"
            $table->integer('poin');      // misal: 50
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penentuan_poin');
    }
};
