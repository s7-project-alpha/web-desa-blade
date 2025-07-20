<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriGaleri;

class KategoriGaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Kegiatan Desa',
                'slug' => 'kegiatan-desa',
                'deskripsi' => 'Dokumentasi berbagai kegiatan yang dilaksanakan di desa',
                'warna_badge' => '#3B82F6',
                'is_active' => true,
                'urutan' => 1
            ],
            [
                'nama_kategori' => 'Wisata',
                'slug' => 'wisata',
                'deskripsi' => 'Foto-foto destinasi wisata dan pemandangan alam desa',
                'warna_badge' => '#10B981',
                'is_active' => true,
                'urutan' => 2
            ],
            [
                'nama_kategori' => 'Pembangunan',
                'slug' => 'pembangunan',
                'deskripsi' => 'Dokumentasi pembangunan infrastruktur dan fasilitas desa',
                'warna_badge' => '#F59E0B',
                'is_active' => true,
                'urutan' => 3
            ],
            [
                'nama_kategori' => 'Budaya',
                'slug' => 'budaya',
                'deskripsi' => 'Kegiatan budaya, tradisi, dan upacara adat desa',
                'warna_badge' => '#8B5CF6',
                'is_active' => true,
                'urutan' => 4
            ],
            [
                'nama_kategori' => 'Ekonomi',
                'slug' => 'ekonomi',
                'deskripsi' => 'Kegiatan ekonomi, UMKM, dan BUMDes',
                'warna_badge' => '#EF4444',
                'is_active' => true,
                'urutan' => 5
            ]
        ];

        foreach ($kategoris as $kategori) {
            KategoriGaleri::create($kategori);
        }
    }
}
