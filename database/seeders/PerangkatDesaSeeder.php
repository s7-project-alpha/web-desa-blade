<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerangkatDesa;

class PerangkatDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perangkatData = [
            // Kepala Desa
            [
                'nama' => 'H. Ahmad Sutrisno, S.Sos',
                'jabatan' => 'Kepala Desa',
                'kategori' => 'kepala_desa',
                'periode' => '2019 - 2025',
                'telepon' => '0812-3456-7890',
                'email' => 'kades@desasukamaju.id',
                'pendidikan' => 'S1 Ilmu Sosial - Universitas Negeri Jakarta',
                'visi' => 'Mewujudkan Desa Sukamaju yang maju, sejahtera, dan mandiri melalui tata kelola pemerintahan yang baik dan partisipasi masyarakat yang aktif.',
                'tugas_tanggung_jawab' => "Memimpin penyelenggaraan pemerintahan desa\nMenetapkan kebijakan desa\nMembina kehidupan masyarakat desa\nMembina perekonomian desa\nMemelihara ketentraman dan ketertiban masyarakat",
                'is_active' => true,
                'urutan' => 1
            ],

            // Perangkat Desa
            [
                'nama' => 'Dra. Siti Aminah',
                'jabatan' => 'Sekretaris Desa',
                'kategori' => 'perangkat_desa',
                'telepon' => '0813-4567-8901',
                'email' => 'sekdes@desasukamaju.id',
                'tugas_tanggung_jawab' => "Administrasi Pemerintahan\nKearsipan\nPerencanaan Program",
                'is_active' => true,
                'urutan' => 1
            ],
            [
                'nama' => 'Budi Santoso, S.E.',
                'jabatan' => 'Bendahara Desa',
                'kategori' => 'perangkat_desa',
                'telepon' => '0814-5678-9012',
                'email' => 'bendahara@desasukamaju.id',
                'tugas_tanggung_jawab' => "Pengelolaan Keuangan\nPelaporan APBDes\nAdministrasi Keuangan",
                'is_active' => true,
                'urutan' => 2
            ],
            [
                'nama' => 'Muhammad Rizki, A.Md.',
                'jabatan' => 'Kaur Pemerintahan',
                'kategori' => 'perangkat_desa',
                'telepon' => '0815-6789-0123',
                'email' => 'kaur.pemerintahan@desasukamaju.id',
                'tugas_tanggung_jawab' => "Pelayanan KTP & KK\nSurat Menyurat\nData Kependudukan",
                'is_active' => true,
                'urutan' => 3
            ],
            [
                'nama' => 'Rina Sari, S.Pd.',
                'jabatan' => 'Kaur Kesejahteraan',
                'kategori' => 'perangkat_desa',
                'telepon' => '0816-7890-1234',
                'email' => 'kaur.kesra@desasukamaju.id',
                'tugas_tanggung_jawab' => "Program Sosial\nKesehatan Masyarakat\nPendidikan",
                'is_active' => true,
                'urutan' => 4
            ],
            [
                'nama' => 'Agus Hermawan',
                'jabatan' => 'Kaur Pembangunan',
                'kategori' => 'perangkat_desa',
                'telepon' => '0817-8901-2345',
                'email' => 'kaur.pembangunan@desasukamaju.id',
                'tugas_tanggung_jawab' => "Infrastruktur Desa\nLingkungan Hidup\nEkonomi Produktif",
                'is_active' => true,
                'urutan' => 5
            ],

            // Kepala Dusun
            [
                'nama' => 'Pak Suryadi',
                'jabatan' => 'Kepala Dusun',
                'kategori' => 'kepala_dusun',
                'dusun' => 'Dusun Mawar',
                'rt_rw' => '4 RT, 2 RW',
                'telepon' => '0818-9012-3456',
                'tugas_tanggung_jawab' => "Koordinasi kegiatan di tingkat dusun\nPembinaan masyarakat\nPelayanan administrasi dusun",
                'is_active' => true,
                'urutan' => 1
            ],
            [
                'nama' => 'Pak Bambang',
                'jabatan' => 'Kepala Dusun',
                'kategori' => 'kepala_dusun',
                'dusun' => 'Dusun Melati',
                'rt_rw' => '3 RT, 2 RW',
                'telepon' => '0819-0123-4567',
                'tugas_tanggung_jawab' => "Koordinasi kegiatan di tingkat dusun\nPembinaan masyarakat\nPelayanan administrasi dusun",
                'is_active' => true,
                'urutan' => 2
            ],
            [
                'nama' => 'Pak Wahyu',
                'jabatan' => 'Kepala Dusun',
                'kategori' => 'kepala_dusun',
                'dusun' => 'Dusun Kenanga',
                'rt_rw' => '5 RT, 3 RW',
                'telepon' => '0820-1234-5678',
                'tugas_tanggung_jawab' => "Koordinasi kegiatan di tingkat dusun\nPembinaan masyarakat\nPelayanan administrasi dusun",
                'is_active' => true,
                'urutan' => 3
            ],

            // BPD
            [
                'nama' => 'H. Sukarno',
                'jabatan' => 'Ketua BPD',
                'kategori' => 'bpd',
                'telepon' => '0821-2345-6789',
                'tugas_tanggung_jawab' => "Membahas dan menyepakati Rancangan Peraturan Desa\nMenampung dan menyalurkan aspirasi masyarakat\nMelakukan pengawasan kinerja Kepala Desa",
                'is_active' => true,
                'urutan' => 1
            ],
            [
                'nama' => 'Hj. Fatimah',
                'jabatan' => 'Wakil Ketua BPD',
                'kategori' => 'bpd',
                'telepon' => '0822-3456-7890',
                'tugas_tanggung_jawab' => "Membantu Ketua BPD\nMewakili ketua jika berhalangan\nKoordinasi dengan anggota BPD",
                'is_active' => true,
                'urutan' => 2
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'jabatan' => 'Sekretaris BPD',
                'kategori' => 'bpd',
                'telepon' => '0823-4567-8901',
                'tugas_tanggung_jawab' => "Administrasi BPD\nNotulensi rapat\nKearsipan dokumen BPD",
                'is_active' => true,
                'urutan' => 3
            ],
            [
                'nama' => 'Siti Khadijah',
                'jabatan' => 'Anggota BPD',
                'kategori' => 'bpd',
                'telepon' => '0824-5678-9012',
                'tugas_tanggung_jawab' => "Menyerap aspirasi masyarakat\nPengawasan program desa\nPartisipasi dalam rapat BPD",
                'is_active' => true,
                'urutan' => 4
            ],
            [
                'nama' => 'Muhammad Yusuf',
                'jabatan' => 'Anggota BPD',
                'kategori' => 'bpd',
                'telepon' => '0825-6789-0123',
                'tugas_tanggung_jawab' => "Menyerap aspirasi masyarakat\nPengawasan program desa\nPartisipasi dalam rapat BPD",
                'is_active' => true,
                'urutan' => 5
            ]
        ];

        foreach ($perangkatData as $data) {
            PerangkatDesa::create($data);
        }
    }
}
