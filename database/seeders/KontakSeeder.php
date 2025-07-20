<?php
// database/seeders/KontakSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kontak;
use App\Models\KontakPejabat;

class KontakSeeder extends Seeder
{
    public function run()
    {
        // Create Kontak Desa
        Kontak::create([
            'nama_kantor' => 'Kantor Desa Tanjung Selamat',
            'alamat' => 'Jl. Raya Desa No. 123, Tanjung Selamat',
            'kecamatan' => 'Kec. Sunggal',
            'kabupaten' => 'Kabupaten Deli Serdang',
            'provinsi' => 'Sumatera Utara',
            'kode_pos' => '20353',
            'email' => 'desatanjungselamat@email.com',
            'telepon' => '(061) 123-4567',
            'fax' => '(061) 123-4568',
            'jam_operasional' => "Senin - Jumat: 08:00 - 16:00 WIB\nSabtu: 08:00 - 12:00 WIB\nMinggu: Tutup",
            'latitude' => 3.6485,  // Koordinat Sunggal, Deli Serdang
            'longitude' => 98.6975,
            'deskripsi' => 'Kantor Desa Tanjung Selamat melayani administrasi dan berbagai keperluan masyarakat desa.',
            'is_active' => true
        ]);

        // Create Kontak Pejabat
        $pejabatData = [
            [
                'nama' => 'H. Ahmad Sutrisno',
                'jabatan' => 'Kepala Desa',
                'telepon' => '0812-3456-7890',
                'email' => 'kades@desatanjungselamat.id',
                'deskripsi' => 'Kepala Desa Tanjung Selamat periode 2019-2025',
                'urutan' => 1,
                'is_active' => true
            ],
            [
                'nama' => 'Dra. Siti Aminah',
                'jabatan' => 'Sekretaris Desa',
                'telepon' => '0813-4567-8901',
                'email' => 'sekdes@desatanjungselamat.id',
                'deskripsi' => 'Sekretaris Desa yang mengkoordinasikan administrasi desa',
                'urutan' => 2,
                'is_active' => true
            ],
            [
                'nama' => 'Budi Santoso, S.E.',
                'jabatan' => 'Bendahara Desa',
                'telepon' => '0814-5678-9012',
                'email' => 'bendahara@desatanjungselamat.id',
                'deskripsi' => 'Bendahara Desa yang mengelola keuangan desa',
                'urutan' => 3,
                'is_active' => true
            ],
            [
                'nama' => 'Ir. Bambang Wijaya',
                'jabatan' => 'Kasi Pemerintahan',
                'telepon' => '0815-6789-0123',
                'email' => 'kasipem@desatanjungselamat.id',
                'deskripsi' => 'Kepala Seksi Pemerintahan',
                'urutan' => 4,
                'is_active' => true
            ],
            [
                'nama' => 'Sri Wahyuni, S.Pd.',
                'jabatan' => 'Kasi Kesra',
                'telepon' => '0816-7890-1234',
                'email' => 'kasikes@desatanjungselamat.id',
                'deskripsi' => 'Kepala Seksi Kesejahteraan Rakyat',
                'urutan' => 5,
                'is_active' => true
            ]
        ];

        foreach ($pejabatData as $data) {
            KontakPejabat::create($data);
        }
    }
}
