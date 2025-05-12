<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
   // database/migrations/xxxx_xx_xx_create_kegiatans_table.php

public function up()
{
    Schema::create('kegiatans', function (Blueprint $table) {
        $table->id();
        $table->string('nim');
        $table->string('nama');
        $table->string('id_kegiatan');
        $table->string('jenis_kegiatan');
        $table->string('nama_kegiatan');
        $table->string('tanggal_kegiatan');
        $table->string('absensi');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
}
