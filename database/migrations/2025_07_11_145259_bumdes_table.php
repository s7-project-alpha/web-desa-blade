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
        // Table utama BUMDes
        Schema::create('bumdes', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('tagline')->nullable(); // "BUMDes Sukamaju Membangun Ekonomi Desa"
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('header_image')->nullable(); // Gambar header yang bisa diubah admin
            $table->string('header_title')->nullable(); // Text overlay di atas gambar
            $table->string('header_subtitle')->nullable(); // Subtitle di atas gambar
            $table->bigInteger('total_aset')->default(0); // dalam rupiah
            $table->decimal('aset_growth', 5, 2)->default(0); // persentase pertumbuhan
            $table->bigInteger('omzet_tahunan')->default(0);
            $table->decimal('omzet_growth', 5, 2)->default(0);
            $table->bigInteger('laba_bersih')->default(0);
            $table->decimal('laba_growth', 5, 2)->default(0);
            $table->integer('anggota_aktif')->default(0);
            $table->decimal('anggota_growth', 5, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Table unit usaha BUMDes
        Schema::create('bumdes_unit_usaha', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bumdes_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['aktif', 'berkembang', 'tidak_aktif'])->default('aktif');
            $table->integer('jumlah_anggota')->default(0);
            $table->string('icon')->nullable(); // untuk icon unit usaha
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Table tim manajemen BUMDes
        Schema::create('bumdes_tim_manajemen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bumdes_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('jabatan');
            $table->text('pengalaman')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bumdes_tim_manajemen');
        Schema::dropIfExists('bumdes_unit_usaha');
        Schema::dropIfExists('bumdes');
    }
};
