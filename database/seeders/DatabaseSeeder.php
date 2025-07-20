<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            VisiMisiSeeder::class,
            DemografiSeeder::class,
            KategoriGaleriSeeder::class,
            GaleriSeeder::class,
            KontakSeeder::class,
            PosyanduSeeder::class,
            KategoriBeritaSeeder::class,
            BeritaSeeder::class,
        ]);
    }
}
