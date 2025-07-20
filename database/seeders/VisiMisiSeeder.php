<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisiMisi;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VisiMisi::create([
            'visi' => 'Terwujudnya Desa Tanjung Selamat yang sejahtera, mandiri, dan berbudaya yang didukung oleh masyarakat yang religius, gotong royong, dan berjiwa wirausaha menuju desa wisata yang berkelanjutan.',
            'misi' => 'Meningkatkan kualitas pelayanan pemerintahan desa yang profesional, transparan, dan akuntabel
Memberdayakan masyarakat melalui pengembangan ekonomi kreatif dan UMKM berbasis potensi lokal
Mewujudkan infrastruktur desa yang memadai untuk mendukung aktivitas ekonomi dan sosial masyarakat
Mengembangkan sektor pertanian dan perkebunan yang modern dan berkelanjutan
Melestarikan budaya lokal dan mengembangkan potensi wisata desa
Meningkatkan kualitas pendidikan dan kesehatan masyarakat
Memperkuat nilai-nilai gotong royong dan kebersamaan dalam kehidupan bermasyarakat',
            'nilai_dasar' => 'Religius - Mengutamakan nilai-nilai keagamaan dalam setiap aktivitas
Gotong Royong - Membangun semangat kebersamaan dan saling membantu
Transparansi - Keterbukaan dalam pengelolaan pemerintahan dan pembangunan
Akuntabilitas - Pertanggungjawaban dalam setiap keputusan dan tindakan
Inovasi - Mengembangkan kreativitas dan solusi baru untuk kemajuan desa
Keberlanjutan - Pembangunan yang memperhatikan kelestarian lingkungan',
            'tujuan' => 'Meningkatkan kesejahteraan ekonomi masyarakat desa
Menciptakan tata kelola pemerintahan yang baik dan bersih
Mewujudkan desa yang mandiri dan berdaya saing
Mengembangkan potensi wisata dan budaya lokal
Meningkatkan kualitas sumber daya manusia',
            'sasaran' => 'Meningkatkan pendapatan per kapita masyarakat sebesar 15% dalam 5 tahun
Mencapai tingkat kepuasan masyarakat terhadap pelayanan publik minimal 85%
Mengembangkan minimal 10 destinasi wisata unggulan
Meningkatkan angka partisipasi pendidikan hingga 98%
Menurunkan angka kemiskinan menjadi di bawah 5%',
            'periode_awal' => '2024',
            'periode_akhir' => '2030',
            'is_active' => true,
        ]);
    }
}
