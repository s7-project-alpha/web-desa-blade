<?php
// database/seeders/PosyanduSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posyandu;
use App\Models\PosyanduTenagaKesehatan;
use App\Models\PosyanduKegiatan;
use App\Models\PosyanduLayanan;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Layanan Posyandu
        $layanan = [
            [
                'nama_layanan' => 'Pemantauan Pertumbuhan',
                'deskripsi' => 'Penimbangan dan pengukuran tinggi badan balita untuk memantau tumbuh kembang',
                'jadwal' => 'Bulanan',
                'target_usia' => '0-5 tahun',
                'icon' => '📊',
            ],
            [
                'nama_layanan' => 'Imunisasi',
                'deskripsi' => 'Pemberian vaksin sesuai jadwal imunisasi nasional untuk mencegah penyakit',
                'jadwal' => 'Sesuai jadwal',
                'target_usia' => '0-2 tahun',
                'icon' => '💉',
            ],
            [
                'nama_layanan' => 'Konseling Gizi',
                'deskripsi' => 'Penyuluhan dan konsultasi tentang gizi seimbang untuk ibu dan balita',
                'jadwal' => 'Setiap kunjungan',
                'target_usia' => 'Ibu & Balita',
                'icon' => '🥗',
            ],
            [
                'nama_layanan' => 'Pemeriksaan Kesehatan',
                'deskripsi' => 'Pemeriksaan kesehatan dasar dan deteksi dini masalah kesehatan',
                'jadwal' => 'Bulanan',
                'target_usia' => 'Semua usia',
                'icon' => '🩺',
            ],
        ];

        foreach ($layanan as $item) {
            PosyanduLayanan::create($item);
        }

        // Seed Tenaga Kesehatan
        $tenagaKesehatan = [
            [
                'nama' => 'Bidan Ani Suryani',
                'gelar' => 'A.Md.Keb',
                'jabatan' => 'Bidan Desa',
                'spesialisasi' => 'Kesehatan Ibu dan Anak',
                'pengalaman_tahun' => 8,
                'telepon' => '0812-1234-5678',
                'email' => 'ani.suryani@email.com',
                'deskripsi' => 'Bidan berpengalaman dalam menangani kesehatan ibu hamil, melahirkan, dan perawatan balita.',
            ],
            [
                'nama' => 'dr. Rizki Pratama',
                'gelar' => '',
                'jabatan' => 'Dokter Puskesmas',
                'spesialisasi' => 'Dokter Umum',
                'pengalaman_tahun' => 5,
                'telepon' => '0813-2345-6789',
                'email' => 'rizki.pratama@email.com',
                'deskripsi' => 'Dokter umum yang melayani pemeriksaan kesehatan umum dan konsultasi medis.',
            ],
            [
                'nama' => 'Perawat Maya Sari',
                'gelar' => 'A.Md.Kep',
                'jabatan' => 'Perawat Puskesmas',
                'spesialisasi' => 'Keperawatan Komunitas',
                'pengalaman_tahun' => 6,
                'telepon' => '0814-3456-7890',
                'email' => 'maya.sari@email.com',
                'deskripsi' => 'Perawat yang berfokus pada pelayanan kesehatan masyarakat dan edukasi kesehatan.',
            ],
        ];

        foreach ($tenagaKesehatan as $item) {
            PosyanduTenagaKesehatan::create($item);
        }

        // Seed Posyandu
        $posyandu = [
            [
                'nama' => 'Posyandu Mawar',
                'deskripsi' => 'Posyandu yang melayani wilayah Dusun Mawar dengan fokus pada kesehatan ibu dan anak',
                'lokasi' => 'Balai Dusun Mawar',
                'dusun' => 'Dusun Mawar',
                'rt_rw' => 'RT 01-02',
                'jadwal' => 'Minggu ke-1 setiap bulan',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:00:00',
                'penanggung_jawab' => 'Ibu Siti Aminah',
                'telepon_penanggung_jawab' => '0812-3456-7890',
                'layanan' => ['Pemeriksaan Balita', 'Imunisasi', 'Konseling Gizi'],
                'anggota_aktif' => 45,
                'total_balita' => 52,
                'balita_gizi_baik' => 48,
                'cakupan_imunisasi' => 96.5,
                'ibu_hamil_aktif' => 8,
            ],
            [
                'nama' => 'Posyandu Melati',
                'deskripsi' => 'Posyandu yang melayani wilayah Dusun Melati dengan pelayanan kesehatan terpadu',
                'lokasi' => 'Balai Dusun Melati',
                'dusun' => 'Dusun Melati',
                'rt_rw' => 'RT 03-04',
                'jadwal' => 'Minggu ke-2 setiap bulan',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:00:00',
                'penanggung_jawab' => 'Ibu Rina Sari',
                'telepon_penanggung_jawab' => '0813-4567-8901',
                'layanan' => ['Pemeriksaan Balita', 'Imunisasi', 'Konseling Gizi'],
                'anggota_aktif' => 38,
                'total_balita' => 45,
                'balita_gizi_baik' => 42,
                'cakupan_imunisasi' => 93.2,
                'ibu_hamil_aktif' => 6,
            ],
            [
                'nama' => 'Posyandu Kenanga',
                'deskripsi' => 'Posyandu yang melayani wilayah Dusun Kenanga dengan program kesehatan ibu dan anak',
                'lokasi' => 'Balai Dusun Kenanga',
                'dusun' => 'Dusun Kenanga',
                'rt_rw' => 'RT 05-06',
                'jadwal' => 'Minggu ke-3 setiap bulan',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:00:00',
                'penanggung_jawab' => 'Ibu Dewi Sartika',
                'telepon_penanggung_jawab' => '0814-5678-9012',
                'layanan' => ['Pemeriksaan Balita', 'Imunisasi', 'Konseling Gizi'],
                'anggota_aktif' => 52,
                'total_balita' => 58,
                'balita_gizi_baik' => 55,
                'cakupan_imunisasi' => 94.8,
                'ibu_hamil_aktif' => 9,
            ],
        ];

        foreach ($posyandu as $item) {
            Posyandu::create($item);
        }

        // Seed Kegiatan Posyandu
        $kegiatan = [
            [
                'nama_kegiatan' => 'Penimbangan Balita dan Imunisasi Polio',
                'deskripsi' => 'Kegiatan rutin posyandu meliputi penimbangan balita dan pemberian imunisasi polio',
                'posyandu_id' => 1, // Posyandu Mawar
                'tanggal' => now()->addDays(3)->toDateString(),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:00:00',
                'agenda' => ['Penimbangan Balita', 'Imunisasi Polio', 'Penyuluhan Gizi'],
                'status' => 'terjadwal',
                'catatan' => 'Silahkan membawa KIA dan KTP',
            ],
            [
                'nama_kegiatan' => 'Pemeriksaan Balita dan Imunisasi DPT',
                'deskripsi' => 'Pemeriksaan kesehatan balita dan pemberian imunisasi DPT',
                'posyandu_id' => 2, // Posyandu Melati
                'tanggal' => now()->addDays(10)->toDateString(),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:00:00',
                'agenda' => ['Penimbangan Balita', 'Imunisasi DPT', 'Konseling Kesehatan'],
                'status' => 'terjadwal',
                'catatan' => 'Khusus untuk balita usia 2-4 bulan',
            ],
            [
                'nama_kegiatan' => 'Posyandu dan Senam Ibu Hamil',
                'deskripsi' => 'Kegiatan posyandu dengan tambahan senam ibu hamil',
                'posyandu_id' => 3, // Posyandu Kenanga
                'tanggal' => now()->addDays(17)->toDateString(),
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:00:00',
                'agenda' => ['Penimbangan Balita', 'Imunisasi Campak', 'Senam Ibu Hamil'],
                'status' => 'terjadwal',
                'catatan' => 'Ibu hamil dianjurkan mengikuti senam',
            ],
        ];

        foreach ($kegiatan as $item) {
            PosyanduKegiatan::create($item);
        }
    }
}
