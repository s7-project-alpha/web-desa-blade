<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Desa Tanjung Selamat',
            'email' => 'admin@desatanjungselamat.id',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'phone' => '081234567890',
            'address' => 'Kantor Desa Tanjung Selamat',
            'is_active' => true,
        ]);
    }
}
