        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration
        {
            public function up(): void
            {
                Schema::create('detail_organisasi_mahasiswa', function (Blueprint $table) {
                    $table->id();
                    $table->string('nim');                         // NIM mahasiswa
                    $table->string('nama');                         // NIM mahasiswa
                    $table->string('id_organisasi');               // ID organisasi
                    $table->string('nama_organisasi');             // Nama organisasi
                    $table->string('jabatan')->nullable();         // Jabatan (Ketua, Sekretaris, dll)
                    $table->string('status_keanggotaan')->nullable(); // Aktif, Tidak Aktif, Alumni, dll
                    $table->timestamps();
                });
            }

            public function down(): void
            {
                Schema::dropIfExists('detail_organisasi_mahasiswa');
            }
        };
