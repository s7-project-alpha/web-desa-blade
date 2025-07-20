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
        Schema::create('demografi', function (Blueprint $table) {
            $table->id();
            $table->integer('total_penduduk');
            $table->integer('total_kepala_keluarga');
            $table->integer('total_laki_laki');
            $table->integer('total_perempuan');
            $table->decimal('luas_wilayah', 8, 2); // km2
            $table->decimal('angka_harapan_hidup', 5, 2); // tahun
            $table->decimal('rasio_jenis_kelamin', 5, 2); // per 100 perempuan
            $table->integer('jumlah_dusun');
            $table->integer('jumlah_rt');
            $table->integer('jumlah_rw');
            $table->json('distribusi_usia'); // {0-5: 100, 6-12: 150, ...}
            $table->json('tingkat_pendidikan'); // {tidak_sekolah: 50, sd: 200, ...}
            $table->json('mata_pencaharian'); // {petani: 300, wiraswasta: 150, ...}
            $table->json('agama'); // {islam: 800, kristen: 100, ...}
            $table->json('status_perkawinan'); // {belum_kawin: 300, kawin: 600, ...}
            $table->year('tahun');
            $table->boolean('is_active')->default(true);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demografi');
    }
};
