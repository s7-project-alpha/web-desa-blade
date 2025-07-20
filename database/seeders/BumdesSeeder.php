<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bumdes;
use App\Models\BumdesUnitUsaha;
use App\Models\BumdesTimManajemen;

class BumdesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main BUMDes data
        $bumdes = Bumdes::create([
            'nama' => 'BUMDes Sukamaju Mandiri',
            'deskripsi' => 'Badan Usaha Milik Desa yang berkomitmen mengembangkan ekonomi lokal dan meningkatkan kesejahteraan masyarakat',
            'tagline' => 'BUMDes Sukamaju Membangun Ekonomi Desa',
            'header_title' => 'BUMDes Sukamaju',
            'header_subtitle' => 'Membangun Ekonomi Desa',
            'visi' => 'Menjadi lembaga ekonomi desa yang mandiri dan berkelanjutan dalam meningkatkan kesejahteraan masyarakat desa melalui pengelolaan potensi ekonomi lokal yang profesional dan inovatif.',
            'misi' => 'Mengembangkan unit usaha yang menguntungkan dan berkelanjutan. Memberikan pelayanan keuangan yang mudah dan terjangkau. Memberdayakan masyarakat melalui program ekonomi produktif. Meningkatkan Pendapatan Asli Desa (PADes).',
            'total_aset' => 285000000, // Rp 285 juta
            'aset_growth' => 12.00,
            'omzet_tahunan' => 320000000, // Rp 320 juta
            'omzet_growth' => 18.00,
            'laba_bersih' => 45000000, // Rp 45 juta
            'laba_growth' => 25.00,
            'anggota_aktif' => 502,
            'anggota_growth' => 8.00,
            'is_active' => true
        ]);

        // Create unit usaha
        $unitUsahaData = [
            [
                'nama' => 'Simpan Pinjam',
                'deskripsi' => 'Layanan kredit mikro untuk modal usaha warga dengan bunga rendah',
                'status' => 'aktif',
                'jumlah_anggota' => 156,
                'icon' => 'fas fa-coins',
                'urutan' => 1
            ],
            [
                'nama' => 'Toko Kebutuhan Pokok',
                'deskripsi' => 'Menyediakan sembako dan kebutuhan sehari-hari dengan harga terjangkau',
                'status' => 'aktif',
                'jumlah_anggota' => 234,
                'icon' => 'fas fa-store',
                'urutan' => 2
            ],
            [
                'nama' => 'Wisata Desa',
                'deskripsi' => 'Pengelolaan objek wisata alam dan budaya desa',
                'status' => 'berkembang',
                'jumlah_anggota' => 23,
                'icon' => 'fas fa-camera',
                'urutan' => 3
            ],
            [
                'nama' => 'Pertanian Organik',
                'deskripsi' => 'Pengembangan pertanian organik dan pemasaran hasil tani',
                'status' => 'aktif',
                'jumlah_anggota' => 89,
                'icon' => 'fas fa-seedling',
                'urutan' => 4
            ]
        ];

        foreach ($unitUsahaData as $unitData) {
            $unitData['bumdes_id'] = $bumdes->id;
            $unitData['is_active'] = true;
            BumdesUnitUsaha::create($unitData);
        }

        // Create tim manajemen
        $timManajemenData = [
            [
                'nama' => 'Budi Hartono, S.E.',
                'jabatan' => 'Direktur Utama',
                'pengalaman' => '5 tahun di bidang koperasi',
                'telepon' => '0812-3456-7890',
                'email' => 'direktur@bumdes-sukamaju.id',
                'urutan' => 1
            ],
            [
                'nama' => 'Sari Dewi, A.Md.',
                'jabatan' => 'Manager Operasional',
                'pengalaman' => '3 tahun di bidang manajemen',
                'telepon' => '0813-4567-8901',
                'email' => 'operasional@bumdes-sukamaju.id',
                'urutan' => 2
            ],
            [
                'nama' => 'Ahmad Rizki',
                'jabatan' => 'Koordinator Wisata',
                'pengalaman' => '2 tahun di bidang pariwisata',
                'telepon' => '0814-5678-9012',
                'email' => 'wisata@bumdes-sukamaju.id',
                'urutan' => 3
            ]
        ];

        foreach ($timManajemenData as $timData) {
            $timData['bumdes_id'] = $bumdes->id;
            $timData['is_active'] = true;
            BumdesTimManajemen::create($timData);
        }
    }
}
