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
        // Tabel utama posyandu
        Schema::create('posyandu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('lokasi');
            $table->string('dusun');
            $table->string('rt_rw');
            $table->string('jadwal'); // contoh: "Minggu ke-1 setiap bulan"
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('penanggung_jawab');
            $table->string('telepon_penanggung_jawab');
            $table->text('layanan'); // JSON array layanan
            $table->integer('anggota_aktif')->default(0);
            $table->integer('total_balita')->default(0);
            $table->integer('balita_gizi_baik')->default(0);
            $table->decimal('cakupan_imunisasi', 5, 2)->default(0); // dalam persen
            $table->integer('ibu_hamil_aktif')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel tenaga kesehatan posyandu
        Schema::create('posyandu_tenaga_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gelar')->nullable();
            $table->string('jabatan');
            $table->string('spesialisasi');
            $table->integer('pengalaman_tahun')->default(0);
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel kegiatan posyandu
        Schema::create('posyandu_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->text('deskripsi')->nullable();
            $table->foreignId('posyandu_id')->constrained('posyandu')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->text('agenda'); // JSON array agenda kegiatan
            $table->enum('status', ['terjadwal', 'berlangsung', 'selesai', 'dibatalkan'])->default('terjadwal');
            $table->text('catatan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel layanan posyandu
        Schema::create('posyandu_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->string('jadwal'); // contoh: "Bulanan", "Sesuai jadwal"
            $table->string('target_usia'); // contoh: "0-5 tahun"
            $table->string('icon')->nullable(); // untuk icon layanan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandu_kegiatan');
        Schema::dropIfExists('posyandu_tenaga_kesehatan');
        Schema::dropIfExists('posyandu_layanan');
        Schema::dropIfExists('posyandu');
    }
};
