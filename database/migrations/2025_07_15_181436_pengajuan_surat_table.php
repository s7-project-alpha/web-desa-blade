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
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengajuan')->unique();
            $table->enum('jenis_surat', [
                'sk_domisili',
                'sk_belum_kawin',
                'sk_usaha',
                'sk_skck',
                'sk_mandah_keluar_masuk',
                'sk_penghasilan_ortu',
                'sk_tidak_mampu'
            ]);
            $table->string('nama');
            $table->string('nomor_whatsapp');
            $table->json('data_surat'); // Field dinamis sesuai jenis surat
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('tanggal_pengajuan')->useCurrent();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();

            $table->index(['jenis_surat', 'status']);
            $table->index('nomor_pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};
