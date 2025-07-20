<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Galeri;
use App\Models\KategoriGaleri;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galeriData = [
            // Kegiatan Desa
            [
                'kategori' => 'kegiatan-desa',
                'judul' => 'Gotong Royong Pembersihan Desa',
                'slug' => 'gotong-royong-pembersihan-desa',
                'deskripsi' => 'Kegiatan gotong royong pembersihan lingkungan desa yang diikuti oleh seluruh warga dengan penuh semangat dan kebersamaan.',
                'photographer' => 'Pak RT 02',
                'lokasi' => 'Jalan Utama Desa',
                'tanggal_foto' => '2024-01-15',
                'is_featured' => true,
                'views_count' => 145
            ],
            [
                'kategori' => 'kegiatan-desa',
                'judul' => 'Rapat Koordinasi Perangkat Desa',
                'slug' => 'rapat-koordinasi-perangkat-desa',
                'deskripsi' => 'Rapat koordinasi bulanan perangkat desa membahas program kerja dan pembangunan desa.',
                'photographer' => 'Tim Dokumentasi',
                'lokasi' => 'Balai Desa',
                'tanggal_foto' => '2024-01-20',
                'is_featured' => false,
                'views_count' => 98
            ],
            [
                'kategori' => 'kegiatan-desa',
                'judul' => 'Pelatihan Komputer untuk Remaja',
                'slug' => 'pelatihan-komputer-untuk-remaja',
                'deskripsi' => 'Program pelatihan komputer dasar untuk remaja desa guna meningkatkan literasi digital.',
                'photographer' => 'Karang Taruna',
                'lokasi' => 'Balai Desa',
                'tanggal_foto' => '2024-02-05',
                'is_featured' => true,
                'views_count' => 234
            ],

            // Wisata
            [
                'kategori' => 'wisata',
                'judul' => 'Pemandangan Alam Desa',
                'slug' => 'pemandangan-alam-desa',
                'deskripsi' => 'Keindahan alam Desa Tanjung Selamat dengan hamparan sawah yang hijau dan pemandangan gunung di kejauhan.',
                'photographer' => 'Ahmad Fotografer',
                'lokasi' => 'Sawah Desa',
                'tanggal_foto' => '2024-01-10',
                'is_featured' => true,
                'views_count' => 567
            ],
            [
                'kategori' => 'wisata',
                'judul' => 'Sunrise di Bukit Tanjung',
                'slug' => 'sunrise-di-bukit-tanjung',
                'deskripsi' => 'Momen sunrise yang memukau di Bukit Tanjung, spot wisata favorit di desa.',
                'photographer' => 'Wisatawan Lokal',
                'lokasi' => 'Bukit Tanjung',
                'tanggal_foto' => '2024-02-14',
                'is_featured' => true,
                'views_count' => 423
            ],
            [
                'kategori' => 'wisata',
                'judul' => 'Air Terjun Mini Desa',
                'slug' => 'air-terjun-mini-desa',
                'deskripsi' => 'Air terjun kecil yang tersembunyi di hutan desa, menjadi tempat favorit anak-anak bermain.',
                'photographer' => 'Pemuda Desa',
                'lokasi' => 'Hutan Desa',
                'tanggal_foto' => '2024-01-25',
                'is_featured' => false,
                'views_count' => 189
            ],

            // Pembangunan
            [
                'kategori' => 'pembangunan',
                'judul' => 'Pembangunan Jalan Desa Tahap II',
                'slug' => 'pembangunan-jalan-desa-tahap-ii',
                'deskripsi' => 'Proses pembangunan jalan desa tahap kedua untuk meningkatkan akses transportasi warga.',
                'photographer' => 'Tim Proyek',
                'lokasi' => 'Jalan Desa RT 03',
                'tanggal_foto' => '2024-02-01',
                'is_featured' => true,
                'views_count' => 312
            ],
            [
                'kategori' => 'pembangunan',
                'judul' => 'Renovasi Balai Desa',
                'slug' => 'renovasi-balai-desa',
                'deskripsi' => 'Proses renovasi balai desa untuk memberikan fasilitas yang lebih baik bagi masyarakat.',
                'photographer' => 'Perangkat Desa',
                'lokasi' => 'Balai Desa',
                'tanggal_foto' => '2024-01-30',
                'is_featured' => false,
                'views_count' => 156
            ],

            // Budaya
            [
                'kategori' => 'budaya',
                'judul' => 'Festival Panen Raya',
                'slug' => 'festival-panen-raya',
                'deskripsi' => 'Perayaan hasil panen yang dilakukan setiap tahun sebagai bentuk syukur dan pelestarian budaya.',
                'photographer' => 'Tim Budaya',
                'lokasi' => 'Lapangan Desa',
                'tanggal_foto' => '2024-02-10',
                'is_featured' => true,
                'views_count' => 445
            ],
            [
                'kategori' => 'budaya',
                'judul' => 'Tarian Tradisional Desa',
                'slug' => 'tarian-tradisional-desa',
                'deskripsi' => 'Penampilan tarian tradisional oleh kelompok seni desa dalam acara festival budaya.',
                'photographer' => 'Kelompok Seni',
                'lokasi' => 'Pendopo Desa',
                'tanggal_foto' => '2024-02-12',
                'is_featured' => false,
                'views_count' => 278
            ],

            // Ekonomi
            [
                'kategori' => 'ekonomi',
                'judul' => 'Pasar Minggu Desa',
                'slug' => 'pasar-minggu-desa',
                'deskripsi' => 'Aktivitas pasar minggu desa dengan berbagai produk lokal dan UMKM warga.',
                'photographer' => 'BUMDes',
                'lokasi' => 'Lapangan Desa',
                'tanggal_foto' => '2024-02-04',
                'is_featured' => false,
                'views_count' => 203
            ],
            [
                'kategori' => 'ekonomi',
                'judul' => 'Pelatihan UMKM Ibu-ibu PKK',
                'slug' => 'pelatihan-umkm-ibu-ibu-pkk',
                'deskripsi' => 'Kegiatan pelatihan UMKM untuk ibu-ibu PKK dalam rangka meningkatkan ekonomi keluarga.',
                'photographer' => 'PKK Desa',
                'lokasi' => 'Balai PKK',
                'tanggal_foto' => '2024-02-08',
                'is_featured' => true,
                'views_count' => 167
            ]
        ];

        foreach ($galeriData as $data) {
            $kategori = KategoriGaleri::where('slug', $data['kategori'])->first();

            if ($kategori) {
                Galeri::create([
                    'kategori_galeri_id' => $kategori->id,
                    'judul' => $data['judul'],
                    'slug' => $data['slug'],
                    'deskripsi' => $data['deskripsi'],
                    'foto_path' => 'galeri/placeholder-' . $data['slug'] . '.jpg', // Placeholder path
                    'foto_original_name' => $data['judul'] . '.jpg',
                    'alt_text' => $data['judul'],
                    'is_featured' => $data['is_featured'],
                    'is_active' => true,
                    'urutan' => 0,
                    'views_count' => $data['views_count'],
                    'photographer' => $data['photographer'],
                    'tanggal_foto' => $data['tanggal_foto'],
                    'lokasi' => $data['lokasi'],
                    'metadata' => [
                        'size' => rand(500000, 2000000), // Random size between 500KB - 2MB
                        'mime_type' => 'image/jpeg',
                        'extension' => 'jpg'
                    ]
                ]);
            }
        }
    }
}
