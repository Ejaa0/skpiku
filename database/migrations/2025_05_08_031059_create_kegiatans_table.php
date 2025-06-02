<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id(); // primary key bigint auto increment
            $table->string('id_kegiatan'); // primary key bigint auto increment
            $table->string('jenis_kegiatan');
            $table->string('nama_kegiatan');
            $table->date('tanggal_kegiatan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
}
