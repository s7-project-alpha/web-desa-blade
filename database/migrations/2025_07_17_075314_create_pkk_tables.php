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
        // Tabel data utama PKK
        Schema::create('pkk', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->default('PKK Desa Tanjung Selamat');
            $table->text('deskripsi')->nullable();
            $table->string('slogan')->nullable();
            $table->text('visi')->nullable();
            $table->integer('anggota_aktif')->default(0);
            $table->integer('program_aktif')->default(0);
            $table->integer('kegiatan_per_tahun')->default(0);
            $table->integer('pokja_aktif')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel program kerja PKK
        Schema::create('pkk_program_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->text('deskripsi');
            $table->json('kegiatan')->nullable(); // Array kegiatan
            $table->integer('peserta_aktif')->default(0);
            $table->string('icon')->nullable();
            $table->string('color')->default('blue');
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Tabel pengurus PKK
        Schema::create('pkk_pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->text('tugas')->nullable();
            $table->string('periode_mulai')->nullable();
            $table->string('periode_selesai')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Tabel kegiatan PKK
        Schema::create('pkk_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->time('waktu')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->integer('jumlah_peserta')->default(0);
            $table->string('foto')->nullable();
            $table->enum('status', ['akan_datang', 'sedang_berlangsung', 'selesai'])->default('akan_datang');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pkk_kegiatan');
        Schema::dropIfExists('pkk_pengurus');
        Schema::dropIfExists('pkk_program_kerja');
        Schema::dropIfExists('pkk');
    }
};
