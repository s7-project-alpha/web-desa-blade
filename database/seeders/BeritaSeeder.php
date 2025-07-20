<?php
// database/seeders/BeritaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\User;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        // Get first admin user or create one
        $admin = User::where('role', 'admin')->first() ?? User::first();

        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin Desa',
                'email' => 'admin@desatanjungselamat.id',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'is_active' => true,
            ]);
        }

        // Get categories
        $kategoris = KategoriBerita::all()->keyBy('slug');

        $beritas = [
            [
                'judul' => 'Pembangunan Jalan Desa Tahap II Dimulai',
                'slug' => 'pembangunan-jalan-desa-tahap-ii-dimulai',
                'ringkasan' => 'Proyek pembangunan jalan desa tahap kedua resmi dimulai hari ini dengan target penyelesaian dalam 3 bulan ke depan. Proyek ini akan menghubungkan 3 RT di wilayah timur desa.',
                'konten' => 'Pemerintah Desa Tanjung Selamat resmi memulai proyek pembangunan jalan desa tahap II pada hari ini, Senin (15 Juni 2024). Proyek yang dianggarkan sebesar Rp 850 juta ini merupakan kelanjutan dari pembangunan jalan desa tahap I yang telah selesai pada bulan Maret lalu.

Kepala Desa Tanjung Selamat, Bapak Samsul Bahri, dalam sambutannya menyatakan bahwa proyek ini sangat penting untuk meningkatkan konektivitas antar wilayah di desa. "Dengan adanya jalan ini, akses masyarakat ke pusat desa akan semakin mudah, terutama untuk warga di RT 05, RT 06, dan RT 07," ujar Kepala Desa.

Proyek pembangunan jalan sepanjang 2,5 kilometer ini akan dikerjakan oleh CV. Karya Mandiri dengan target penyelesaian selama 3 bulan. Jalan yang dibangun akan menggunakan spesifikasi cor beton dengan lebar 4 meter, dilengkapi dengan saluran drainase di kedua sisi.

Sekretaris Desa, Ibu Siti Aminah, menjelaskan bahwa dana untuk proyek ini berasal dari Anggaran Pendapatan dan Belanja Desa (APBDes) tahun 2024 sebesar 60% dan bantuan dari Pemerintah Kabupaten sebesar 40%. "Kami berharap proyek ini dapat berjalan sesuai rencana dan memberikan manfaat maksimal bagi masyarakat," tambahnya.

Masyarakat yang akan terdampak langsung dari pembangunan jalan ini menyambut baik program ini. Bapak Ahmad Syafi\'i, warga RT 05, mengungkapkan rasa syukurnya. "Selama ini kami kesulitan saat musim hujan karena jalan yang masih tanah. Dengan adanya jalan cor ini, kami sangat terbantu."

Kepala Desa juga menekankan pentingnya partisipasi masyarakat dalam menjaga dan merawat infrastruktur yang telah dibangun. "Jalan ini adalah milik bersama, mari kita jaga dengan baik agar dapat dimanfaatkan dalam jangka waktu yang lama," pungkasnya.',
                'kategori_berita_id' => $kategoris['pembangunan']->id,
                'jenis' => 'berita',
                'status' => 'published',
                'is_featured' => true,
                'views' => 245,
                'tanggal_publikasi' => Carbon::parse('2024-06-15'),
                'published_at' => Carbon::parse('2024-06-15 08:00:00'),
                'tags' => ['pembangunan', 'infrastruktur', 'jalan', 'desa'],
                'penulis' => 'Admin Desa',
                'user_id' => $admin->id,
                'is_active' => true,
            ],
            [
                'judul' => 'Festival Panen Raya 2024 Sukses Digelar',
                'slug' => 'festival-panen-raya-2024-sukses-digelar',
                'ringkasan' => 'Masyarakat desa antusias mengikuti Festival Panen Raya 2024 yang menghadirkan berbagai lomba tradisional dan pameran hasil pertanian.',
                'konten' => 'Festival Panen Raya 2024 yang diselenggarakan di lapangan desa pada Minggu (12 Juni 2024) telah berlangsung meriah dan sukses. Acara yang dimulai pukul 08.00 WIB ini dihadiri oleh hampir seluruh warga desa serta tamu undangan dari desa-desa tetangga.

Acara dibuka langsung oleh Kepala Desa Tanjung Selamat yang dalam sambutannya mengucapkan syukur atas hasil panen yang melimpah tahun ini. "Alhamdulillah, tahun ini hasil panen padi kita meningkat 15% dibandingkan tahun lalu. Ini adalah berkah yang harus kita syukuri bersama."

Festival yang mengangkat tema "Bersyukur dan Berbagi" ini menampilkan berbagai kegiatan menarik. Lomba yang digelar antara lain lomba makan kerupuk, balap karung, tarik tambang, dan lomba memasak tradisional. Peserta lomba tidak hanya dari kalangan dewasa, tetapi juga anak-anak dan remaja.

Pameran hasil pertanian menjadi daya tarik tersendiri dalam festival ini. Berbagai produk pertanian lokal dipamerkan, mulai dari padi, jagung, sayuran organik, hingga buah-buahan. Beberapa kelompok tani juga memamerkan inovasi pertanian terbaru yang telah mereka terapkan.

Ibu Maryati, ketua Tim Penggerak PKK Desa, mengatakan bahwa festival ini juga menjadi ajang untuk mempererat tali silaturahmi antar warga. "Acara seperti ini sangat penting untuk menjaga kebersamaan dan gotong royong yang menjadi ciri khas masyarakat desa kita."

Salah satu momen paling mengharukan adalah saat pembagian hasil panen kepada warga yang kurang mampu. Sebanyak 50 keluarga menerima bantuan beras dan sayuran hasil panen bersama.

Acara ditutup dengan penampilan kesenian tradisional dari sanggar budaya desa dan doa bersama untuk keberkahan hasil pertanian di masa mendatang. Festival Panen Raya direncanakan akan menjadi agenda tahunan desa.',
                'kategori_berita_id' => $kategoris['budaya']->id,
                'jenis' => 'berita',
                'status' => 'published',
                'is_featured' => true,
                'views' => 189,
                'tanggal_publikasi' => Carbon::parse('2024-06-12'),
                'published_at' => Carbon::parse('2024-06-12 14:30:00'),
                'tags' => ['festival', 'panen', 'budaya', 'tradisi'],
                'penulis' => 'Tim Humas',
                'user_id' => $admin->id,
                'is_active' => true,
            ],
            [
                'judul' => 'Program Posyandu Balita Menunjukkan Hasil Positif',
                'slug' => 'program-posyandu-balita-menunjukkan-hasil-positif',
                'ringkasan' => 'Kegiatan Posyandu bulanan menunjukkan peningkatan status gizi balita di desa mencapai 95%, naik dari 87% tahun lalu.',
                'konten' => 'Program Posyandu balita di Desa Tanjung Selamat menunjukkan hasil yang sangat menggembirakan. Berdasarkan data evaluasi semester pertama tahun 2024, tingkat gizi baik balita mencapai 95%, meningkat signifikan dari 87% pada periode yang sama tahun lalu.

Bidan Desa, Ibu dr. Sari Dewi, menjelaskan bahwa peningkatan ini tidak lepas dari peran aktif kader Posyandu dan kesadaran orang tua untuk rutin membawa balita ke Posyandu. "Kami melakukan Posyandu setiap bulan di 5 lokasi berbeda untuk memudahkan akses masyarakat."

Data menunjukkan bahwa dari 156 balita yang ada di desa, 148 balita memiliki status gizi baik, 6 balita gizi kurang, dan 2 balita dalam pemantauan khusus. Untuk balita dengan gizi kurang, sudah mendapat penanganan khusus berupa pemberian makanan tambahan dan konseling gizi kepada orang tua.

Kepala Desa mengapresiasi kerja keras tim kesehatan desa dan para kader. "Program ini adalah prioritas kami karena anak-anak adalah masa depan desa. Kami akan terus mendukung program kesehatan ini dengan alokasi anggaran yang memadai."

Ibu Ratna, salah satu kader Posyandu, mengungkapkan bahwa antusiasme ibu-ibu untuk datang ke Posyandu semakin meningkat. "Sekarang rata-rata 30-35 balita hadir setiap bulannya di setiap pos. Ini jauh lebih baik dibanding dulu yang hanya 15-20 balita."

Program inovasi yang dijalankan meliputi pemberian vitamin, imunisasi lengkap, penimbangan rutin, dan edukasi gizi. Selain itu, juga ada program pemberian makanan tambahan berupa bubur kacang hijau dan susu untuk balita yang mengalami gizi kurang.

Tim kesehatan berencana mengembangkan program ini dengan menambah fasilitas alat kesehatan dan pelatihan kader yang lebih intensif. Target untuk tahun depan adalah mencapai tingkat gizi baik balita hingga 98%.',
                'kategori_berita_id' => $kategoris['kesehatan']->id,
                'jenis' => 'berita',
                'status' => 'published',
                'views' => 156,
                'tanggal_publikasi' => Carbon::parse('2024-06-10'),
                'published_at' => Carbon::parse('2024-06-10 10:15:00'),
                'tags' => ['posyandu', 'kesehatan', 'balita', 'gizi'],
                'user_id' => $admin->id,
                'is_active' => true,
            ],
            [
                'judul' => 'PENGUMUMAN: Pelaksanaan Musyawarah Desa Tahun 2024',
                'slug' => 'pengumuman-pelaksanaan-musyawarah-desa-tahun-2024',
                'ringkasan' => 'Pemerintah Desa Tanjung Selamat mengundang seluruh warga untuk menghadiri Musyawarah Desa yang akan dilaksanakan pada 25 Juni 2024.',
                'konten' => 'Dengan hormat,

Pemerintah Desa Tanjung Selamat mengundang seluruh warga masyarakat untuk menghadiri Musyawarah Desa (Musdes) Tahun 2024 yang akan membahas:

1. Laporan Pertanggungjawaban APBDes Tahun 2023
2. Rencana Pembangunan Desa Tahun 2025
3. Penetapan prioritas program pembangunan
4. Evaluasi program kerja yang telah berjalan

WAKTU DAN TEMPAT:
- Hari/Tanggal: Selasa, 25 Juni 2024
- Waktu: 19.00 WIB s.d selesai
- Tempat: Balai Desa Tanjung Selamat

PESERTA:
- Perangkat Desa
- Ketua RT/RW
- Tokoh masyarakat
- Ketua organisasi kemasyarakatan
- Perwakilan kelompok tani
- Perwakilan UMKM
- Masyarakat umum

Kehadiran Bapak/Ibu/Saudara sangat kami harapkan untuk bersama-sama membangun desa yang lebih baik.

Demikian pengumuman ini kami sampaikan. Atas perhatian dan kehadiran Bapak/Ibu/Saudara, kami ucapkan terima kasih.

Tanjung Selamat, 8 Juni 2024
Kepala Desa Tanjung Selamat

Samsul Bahri',
                'kategori_berita_id' => $kategoris['pengumuman']->id,
                'jenis' => 'pengumuman',
                'status' => 'published',
                'is_urgent' => true,
                'views' => 342,
                'tanggal_publikasi' => Carbon::parse('2024-06-08'),
                'tanggal_berakhir' => Carbon::parse('2024-06-25'),
                'published_at' => Carbon::parse('2024-06-08 16:00:00'),
                'tags' => ['musyawarah', 'desa', 'pengumuman', 'apbdes'],
                'user_id' => $admin->id,
                'is_active' => true,
            ],
            [
                'judul' => 'Pelatihan Keterampilan Menjahit untuk Ibu-Ibu PKK',
                'slug' => 'pelatihan-keterampilan-menjahit-untuk-ibu-ibu-pkk',
                'ringkasan' => 'Program pelatihan keterampilan menjahit yang diikuti 25 ibu-ibu PKK bertujuan meningkatkan kemampuan ekonomi keluarga.',
                'konten' => 'Balai Desa Tanjung Selamat menjadi pusat aktivitas pembelajaran selama tiga hari berturut-turut (5-7 Juni 2024) ketika 25 ibu-ibu anggota PKK mengikuti pelatihan keterampilan menjahit. Program ini merupakan bagian dari upaya pemberdayaan ekonomi keluarga melalui pengembangan keterampilan.

Pelatihan yang dipandu oleh Ibu Sari Handayani, instruktur menjahit berpengalaman dari Kabupaten, memberikan materi lengkap mulai dari dasar-dasar menjahit hingga teknik pembuatan pakaian sederhana. Peserta diajarkan cara menggunakan mesin jahit, mengukur badan, membuat pola, dan teknik jahit yang rapi.

Ketua PKK Desa, Ibu Maryati, menjelaskan bahwa program ini adalah jawaban atas aspirasi ibu-ibu yang ingin memiliki keterampilan tambahan untuk meningkatkan penghasilan keluarga. "Banyak ibu-ibu yang sudah lama ingin belajar menjahit tapi tidak ada kesempatan. Sekarang kami fasilitasi melalui program PKK."

Selama tiga hari pelatihan, peserta berhasil membuat berbagai produk seperti tas belanja kain, sarung bantal, dan beberapa model blus sederhana. Semua bahan dan peralatan disediakan oleh panitia sehingga peserta tidak perlu mengeluarkan biaya.

Ibu Aminah, salah satu peserta dari RT 03, mengungkapkan kepuasannya. "Saya senang sekali bisa belajar menjahit. Mudah-mudahan setelah ini bisa buka usaha kecil-kecilan di rumah untuk nambah penghasilan keluarga."

Instruktur pelatihan memberikan apresiasi terhadap antusiasme peserta. "Ibu-ibu di sini sangat antusias dan cepat belajar. Saya yakin mereka bisa mengembangkan keterampilan ini menjadi usaha yang menguntungkan."

Sebagai tindak lanjut, PKK Desa berencana membentuk kelompok usaha menjahit dan memberikan bantuan modal usaha melalui program Dana Desa. Rencananya, dalam dua bulan ke depan akan diadakan pelatihan lanjutan untuk membuat produk yang lebih kompleks.',
                'kategori_berita_id' => $kategoris['ekonomi']->id,
                'jenis' => 'berita',
                'status' => 'published',
                'views' => 98,
                'tanggal_publikasi' => Carbon::parse('2024-06-07'),
                'published_at' => Carbon::parse('2024-06-07 11:20:00'),
                'tags' => ['pkk', 'pelatihan', 'menjahit', 'ekonomi', 'pemberdayaan'],
                'user_id' => $admin->id,
                'is_active' => true,
            ],
            [
                'judul' => 'Gotong Royong Pembersihan Saluran Air Jelang Musim Hujan',
                'slug' => 'gotong-royong-pembersihan-saluran-air-jelang-musim-hujan',
                'ringkasan' => 'Seluruh warga bergotong royong membersihkan saluran air dan drainase desa untuk mencegah banjir saat musim hujan tiba.',
                'konten' => 'Semangat gotong royong masyarakat Desa Tanjung Selamat kembali terlihat dalam kegiatan pembersihan saluran air yang dilaksanakan pada Sabtu (4 Juni 2024). Kegiatan yang dimulai pukul 07.00 WIB ini diikuti oleh hampir 200 warga dari berbagai RT dan RW.

Kegiatan ini merupakan program rutin yang dilaksanakan menjelang musim hujan untuk mencegah terjadinya banjir dan genangan air. Kepala Desa yang turut turun langsung dalam kegiatan ini menekankan pentingnya kerjasama semua pihak dalam menjaga lingkungan.

"Pembersihan saluran ini sangat penting untuk antisipasi musim hujan. Tahun lalu ada beberapa titik yang sempat tergenang karena saluran tersumbat sampah," ujar Kepala Desa sambil ikut membersihkan got.

Kegiatan dibagi dalam beberapa kelompok berdasarkan wilayah RT/RW. Masing-masing kelompok bertanggung jawab membersihkan saluran air di wilayahnya. Sampah yang dikumpulkan mayoritas berupa daun-daun kering, plastik, dan endapan lumpur.

Bapak Jamal, Ketua RW 02, mengapresiasi partisipasi warga yang sangat antusias. "Alhamdulillah, tidak ada yang menyuruh tapi warga sudah berkumpul sendiri membawa peralatan. Ini bukti kalau semangat gotong royong masih kuat di desa kita."

Selain membersihkan saluran air, kegiatan ini juga sekaligus melakukan perbaikan kecil seperti menambal lubang-lubang di saluran beton dan membersihkan rumput liar yang tumbuh di sekitar saluran.

Untuk menunjang kegiatan, Pemerintah Desa menyediakan peralatan seperti cangkul, sapu lidi, karung untuk sampah, dan konsumsi untuk seluruh peserta. Sampah yang terkumpul langsung diangkut oleh mobil sampah desa.

Ibu-ibu PKK juga turut berpartisipasi dengan menyiapkan konsumsi dan minuman untuk para peserta. "Kami senang bisa berkontribusi. Biasanya kalau ada kegiatan seperti ini, ibu-ibu selalu siap membantu," kata Ibu Siti, salah satu anggota PKK.

Kegiatan yang berlangsung hingga pukul 11.00 WIB ini berhasil membersihkan total 3,2 kilometer saluran air di seluruh wilayah desa. Sebagai tindak lanjut, akan dibentuk tim pemantau untuk melakukan pengecekan rutin setiap bulan.',
                'kategori_berita_id' => $kategoris['lingkungan']->id,
                'jenis' => 'berita',
                'status' => 'published',
                'views' => 134,
                'tanggal_publikasi' => Carbon::parse('2024-06-04'),
                'published_at' => Carbon::parse('2024-06-04 15:45:00'),
                'tags' => ['gotong royong', 'lingkungan', 'saluran air', 'banjir'],
                'user_id' => $admin->id,
                'is_active' => true,
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::updateOrCreate(
                ['slug' => $berita['slug']],
                $berita
            );
        }
    }
}
