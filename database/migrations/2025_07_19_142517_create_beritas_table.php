<?php
// database/migrations/2024_01_15_000002_create_beritas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('ringkasan');
            $table->longText('konten');
            $table->string('gambar_utama')->nullable();
            $table->foreignId('kategori_berita_id')->constrained('kategori_beritas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Author
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->enum('jenis', ['berita', 'pengumuman'])->default('berita');
            $table->boolean('is_featured')->default(false); // Berita utama
            $table->boolean('is_urgent')->default(false); // Pengumuman penting
            $table->integer('views')->default(0);
            $table->date('tanggal_publikasi')->nullable();
            $table->date('tanggal_berakhir')->nullable(); // Untuk pengumuman
            $table->json('tags')->nullable(); // Array tags
            $table->json('galeri')->nullable(); // Array gambar tambahan
            $table->string('sumber')->nullable(); // Sumber berita
            $table->string('penulis')->nullable(); // Override author name
            $table->boolean('allow_comments')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['status', 'is_active']);
            $table->index(['kategori_berita_id', 'status']);
            $table->index(['jenis', 'status']);
            $table->index(['is_featured', 'status']);
            $table->index('tanggal_publikasi');
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
