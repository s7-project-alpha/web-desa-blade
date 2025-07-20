<?php
// database/seeders/KategoriBeritaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBerita;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Pengumuman',
                'slug' => 'pengumuman',
                'deskripsi' => 'Pengumuman resmi dari pemerintah desa',
                'warna' => '#F59E0B',
                'icon' => 'fas fa-bullhorn',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'nama' => 'Pembangunan',
                'slug' => 'pembangunan',
                'deskripsi' => 'Berita seputar pembangunan infrastruktur desa',
                'warna' => '#10B981',
                'icon' => 'fas fa-hammer',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'nama' => 'Budaya',
                'slug' => 'budaya',
                'deskripsi' => 'Kegiatan budaya dan tradisi desa',
                'warna' => '#8B5CF6',
                'icon' => 'fas fa-theater-masks',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'nama' => 'Kesehatan',
                'slug' => 'kesehatan',
                'deskripsi' => 'Informasi kesehatan dan program kesehatan desa',
                'warna' => '#EF4444',
                'icon' => 'fas fa-heartbeat',
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'nama' => 'Pendidikan',
                'slug' => 'pendidikan',
                'deskripsi' => 'Program dan kegiatan pendidikan di desa',
                'warna' => '#3B82F6',
                'icon' => 'fas fa-graduation-cap',
                'urutan' => 5,
                'is_active' => true,
            ],
            [
                'nama' => 'Ekonomi',
                'slug' => 'ekonomi',
                'deskripsi' => 'Program ekonomi dan UMKM desa',
                'warna' => '#059669',
                'icon' => 'fas fa-chart-line',
                'urutan' => 6,
                'is_active' => true,
            ],
            [
                'nama' => 'Lingkungan',
                'slug' => 'lingkungan',
                'deskripsi' => 'Program lingkungan dan kebersihan desa',
                'warna' => '#84CC16',
                'icon' => 'fas fa-leaf',
                'urutan' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriBerita::updateOrCreate(
                ['slug' => $kategori['slug']],
                $kategori
            );
        }
    }
}
