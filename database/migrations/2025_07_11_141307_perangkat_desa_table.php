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
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('periode')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->text('pendidikan')->nullable();
            $table->text('visi')->nullable();
            $table->text('tugas_tanggung_jawab')->nullable();
            $table->string('foto')->nullable();
            $table->enum('kategori', ['kepala_desa', 'perangkat_desa', 'kepala_dusun', 'bpd'])->default('perangkat_desa');
            $table->string('dusun')->nullable(); // untuk kepala dusun
            $table->string('rt_rw')->nullable(); // untuk kepala dusun
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0); // untuk pengurutan tampilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat_desa');
    }
};
