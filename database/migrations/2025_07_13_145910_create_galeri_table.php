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
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_galeri_id')->constrained('kategori_galeri')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('foto_path'); // Path ke file foto
            $table->string('foto_original_name')->nullable(); // Nama original file
            $table->string('alt_text')->nullable(); // Alt text untuk SEO
            $table->boolean('is_featured')->default(false); // Untuk foto unggulan
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->integer('views_count')->default(0);
            $table->string('photographer')->nullable(); // Nama fotografer
            $table->date('tanggal_foto')->nullable(); // Tanggal foto diambil
            $table->string('lokasi')->nullable(); // Lokasi foto diambil
            $table->json('metadata')->nullable(); // Metadata foto (ukuran, format, etc)
            $table->timestamps();

            $table->index(['kategori_galeri_id', 'is_active']);
            $table->index(['is_featured', 'is_active']);
            $table->index(['slug']);
            $table->index(['created_at', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
