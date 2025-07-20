<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Demografi;

class DemografiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Demografi::create([
            'total_penduduk' => 2580,
            'total_kepala_keluarga' => 745,
            'total_laki_laki' => 1320,
            'total_perempuan' => 1260,
            'luas_wilayah' => 12.5,
            'angka_harapan_hidup' => 72.5,
            'rasio_jenis_kelamin' => 104.76, // (1320/1260) * 100
            'jumlah_dusun' => 8,
            'jumlah_rt' => 24,
            'jumlah_rw' => 8,
            'distribusi_usia' => [
                '0_5' => 185,
                '6_12' => 220,
                '13_17' => 195,
                '18_25' => 380,
                '26_35' => 420,
                '36_45' => 350,
                '46_55' => 280,
                '56_65' => 225,
                '65_plus' => 325,
            ],
            'tingkat_pendidikan' => [
                'tidak_sekolah' => 120,
                'belum_tamat_sd' => 180,
                'sd' => 650,
                'smp' => 580,
                'sma' => 720,
                'diploma' => 185,
                's1' => 125,
                's2' => 18,
                's3' => 2,
            ],
            'mata_pencaharian' => [
                'petani' => 850,
                'buruh_tani' => 320,
                'peternak' => 180,
                'nelayan' => 25,
                'pedagang' => 220,
                'wiraswasta' => 285,
                'pns' => 95,
                'tni_polri' => 18,
                'guru' => 45,
                'bidan_perawat' => 12,
                'pensiunan' => 85,
                'tidak_bekerja' => 445,
                'lainnya' => 120,
            ],
            'agama' => [
                'islam' => 2420,
                'kristen' => 95,
                'katolik' => 45,
                'hindu' => 15,
                'buddha' => 3,
                'khonghucu' => 1,
                'lainnya' => 1,
            ],
            'status_perkawinan' => [
                'belum_kawin' => 780,
                'kawin' => 1580,
                'cerai_hidup' => 85,
                'cerai_mati' => 135,
            ],
            'tahun' => 2024,
            'is_active' => true,
            'keterangan' => 'Data demografi berdasarkan sensus penduduk tahun 2024. Data ini digunakan sebagai dasar perencanaan pembangunan desa dan program-program kemasyarakatan.',
        ]);
    }
}
