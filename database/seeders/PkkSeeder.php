<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pkk;
use App\Models\PkkProgramKerja;
use App\Models\PkkPengurus;
use App\Models\PkkKegiatan;
use Carbon\Carbon;

class PkkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main PKK data
        $pkk = Pkk::create([
            'judul' => 'PKK Desa Tanjung Selamat',
            'deskripsi' => 'Pemberdayaan Kesejahteraan Keluarga - Menggerakkan dan memberdayakan perempuan untuk meningkatkan kesejahteraan keluarga dan masyarakat',
            'slogan' => 'Wanita Hebat, Keluarga Sejahtera',
            'visi' => 'Bersama membangun keluarga yang bahagia dan sejahtera',
            'anggota_aktif' => 156,
            'program_aktif' => 24,
            'kegiatan_per_tahun' => 89,
            'pokja_aktif' => 12,
            'is_active' => true,
        ]);

        // Create program kerja
        $programKerja = [
            [
                'nama_program' => 'Penghayatan dan Pengamalan Pancasila',
                'deskripsi' => 'Program peningkatan pemahaman dan pengamalan nilai-nilai Pancasila dalam kehidupan sehari-hari',
                'kegiatan' => [
                    'Ceramah Pancasila',
                    'Lomba 17 Agustus',
                    'Upacara Bendera'
                ],
                'peserta_aktif' => 85,
                'icon' => 'star',
                'color' => 'blue',
                'urutan' => 1,
            ],
            [
                'nama_program' => 'Gotong Royong',
                'deskripsi' => 'Kegiatan gotong royong untuk kebersihan lingkungan dan pembangunan desa',
                'kegiatan' => [
                    'Kerja Bakti Mingguan',
                    'Pembersihan Sungai',
                    'Penanaman Pohon'
                ],
                'peserta_aktif' => 120,
                'icon' => 'users',
                'color' => 'green',
                'urutan' => 2,
            ],
            [
                'nama_program' => 'Pangan',
                'deskripsi' => 'Program ketahanan pangan dan peningkatan gizi keluarga',
                'kegiatan' => [
                    'Pelatihan Memasak',
                    'Kebun Keluarga',
                    'Posyandu Balita'
                ],
                'peserta_aktif' => 95,
                'icon' => 'home',
                'color' => 'yellow',
                'urutan' => 3,
            ],
            [
                'nama_program' => 'Sandang',
                'deskripsi' => 'Pelatihan keterampilan menjahit dan kerajinan tangan',
                'kegiatan' => [
                    'Kursus Menjahit',
                    'Kerajinan Tas',
                    'Sulam dan Bordir'
                ],
                'peserta_aktif' => 65,
                'icon' => 'heart',
                'color' => 'red',
                'urutan' => 4,
            ],
            [
                'nama_program' => 'Pendidikan dan Keterampilan',
                'deskripsi' => 'Program pendidikan dan pelatihan keterampilan untuk ibu-ibu',
                'kegiatan' => [
                    'Kelas Komputer',
                    'Kursus Bahasa Inggris',
                    'Pelatihan UMKM'
                ],
                'peserta_aktif' => 78,
                'icon' => 'book',
                'color' => 'purple',
                'urutan' => 5,
            ],
        ];

        foreach ($programKerja as $program) {
            PkkProgramKerja::create($program);
        }

        // Create pengurus
        $pengurus = [
            [
                'nama' => 'Hj. Siti Nurjannah',
                'jabatan' => 'Ketua Tim Penggerak PKK',
                'deskripsi' => 'Aktif di PKK sejak 2018',
                'telepon' => '0812-3456-7890',
                'email' => 'siti.nurjannah@gmail.com',
                'tugas' => 'Memimpin dan mengkoordinasikan seluruh kegiatan PKK di desa',
                'periode_mulai' => '2023',
                'periode_selesai' => '2028',
                'urutan' => 1,
            ],
            [
                'nama' => 'Ibu Aminah Wati',
                'jabatan' => 'Wakil Ketua',
                'deskripsi' => 'Koordinator program pangan',
                'telepon' => '0813-4567-8901',
                'email' => 'aminah.wati@gmail.com',
                'tugas' => 'Membantu ketua dalam mengkoordinasikan kegiatan PKK',
                'periode_mulai' => '2023',
                'periode_selesai' => '2028',
                'urutan' => 2,
            ],
            [
                'nama' => 'Ibu Rina Sari',
                'jabatan' => 'Sekretaris',
                'deskripsi' => 'Ahli administrasi dan kearsipan',
                'telepon' => '0814-5678-9012',
                'email' => 'rina.sari@gmail.com',
                'tugas' => 'Mengelola administrasi dan dokumentasi kegiatan PKK',
                'periode_mulai' => '2023',
                'periode_selesai' => '2028',
                'urutan' => 3,
            ],
            [
                'nama' => 'Ibu Dewi Sartika',
                'jabatan' => 'Bendahara',
                'deskripsi' => 'Mengelola keuangan PKK',
                'telepon' => '0815-6789-0123',
                'email' => 'dewi.sartika@gmail.com',
                'tugas' => 'Mengelola keuangan dan administrasi keuangan PKK',
                'periode_mulai' => '2023',
                'periode_selesai' => '2028',
                'urutan' => 4,
            ],
            [
                'nama' => 'Ibu Tri Wahyuni',
                'jabatan' => 'Ketua Pokja I',
                'deskripsi' => 'Penanggung jawab bidang penghayatan dan pengamalan Pancasila',
                'telepon' => '0816-7890-1234',
                'email' => 'tri.wahyuni@gmail.com',
                'tugas' => 'Mengkoordinasikan kegiatan penghayatan dan pengamalan Pancasila',
                'periode_mulai' => '2023',
                'periode_selesai' => '2028',
                'urutan' => 5,
            ],
            [
                'nama' => 'Ibu Lestari',
                'jabatan' => 'Ketua Pokja II',
                'deskripsi' => 'Penanggung jawab bidang gotong royong',
                'telepon' => '0817-8901-2345',
                'email' => 'lestari@gmail.com',
                'tugas' => 'Mengkoordinasikan kegiatan gotong royong dan kebersihan lingkungan',
                'periode_mulai' => '2023',
                'periode_selesai' => '2028',
                'urutan' => 6,
            ],
        ];

        foreach ($pengurus as $person) {
            PkkPengurus::create($person);
        }

        // Create kegiatan
        $kegiatan = [
            [
                'nama_kegiatan' => 'Pelatihan Memasak Sehat',
                'deskripsi' => 'Pelatihan memasak makanan sehat dan bergizi untuk keluarga dengan bahan-bahan lokal yang mudah didapat',
                'tanggal' => Carbon::now()->addDays(7),
                'waktu' => '09:00',
                'lokasi' => 'Balai Desa Tanjung Selamat',
                'penanggung_jawab' => 'Ibu Aminah Wati',
                'jumlah_peserta' => 30,
                'status' => 'akan_datang',
            ],
            [
                'nama_kegiatan' => 'Kerja Bakti Lingkungan',
                'deskripsi' => 'Kerja bakti membersihkan lingkungan desa dan saluran air untuk mencegah banjir',
                'tanggal' => Carbon::now()->addDays(14),
                'waktu' => '07:00',
                'lokasi' => 'Seluruh wilayah desa',
                'penanggung_jawab' => 'Ibu Lestari',
                'jumlah_peserta' => 85,
                'status' => 'akan_datang',
            ],
            [
                'nama_kegiatan' => 'Kursus Menjahit Dasar',
                'deskripsi' => 'Kursus menjahit untuk pemula dengan materi dasar-dasar menjahit dan membuat pakaian sederhana',
                'tanggal' => Carbon::now()->subDays(3),
                'waktu' => '14:00',
                'lokasi' => 'Rumah Ibu Siti Nurjannah',
                'penanggung_jawab' => 'Ibu Dewi Sartika',
                'jumlah_peserta' => 20,
                'status' => 'selesai',
            ],
            [
                'nama_kegiatan' => 'Posyandu Balita',
                'deskripsi' => 'Pemeriksaan kesehatan rutin untuk balita dan ibu hamil serta penyuluhan gizi',
                'tanggal' => Carbon::now(),
                'waktu' => '08:00',
                'lokasi' => 'Posyandu Melati',
                'penanggung_jawab' => 'Ibu Tri Wahyuni',
                'jumlah_peserta' => 45,
                'status' => 'sedang_berlangsung',
            ],
            [
                'nama_kegiatan' => 'Pelatihan UMKM Digital',
                'deskripsi' => 'Pelatihan cara memasarkan produk UMKM melalui media digital dan online',
                'tanggal' => Carbon::now()->addDays(21),
                'waktu' => '10:00',
                'lokasi' => 'Balai Desa Tanjung Selamat',
                'penanggung_jawab' => 'Ibu Rina Sari',
                'jumlah_peserta' => 25,
                'status' => 'akan_datang',
            ],
            [
                'nama_kegiatan' => 'Lomba Masak Tradisional',
                'deskripsi' => 'Lomba memasak makanan tradisional untuk melestarikan kuliner daerah',
                'tanggal' => Carbon::now()->subDays(10),
                'waktu' => '09:00',
                'lokasi' => 'Lapangan Desa',
                'penanggung_jawab' => 'Ibu Aminah Wati',
                'jumlah_peserta' => 40,
                'status' => 'selesai',
            ],
        ];

        foreach ($kegiatan as $activity) {
            PkkKegiatan::create($activity);
        }
    }
}
