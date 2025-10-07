<?php
// database/factories/VisitorLogFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class VisitorLogFactory extends Factory
{
    protected $model = \App\Models\VisitorLog::class;

    public function definition()
    {
        $browsers = ['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera'];
        $platforms = ['Windows', 'Mac OS', 'Linux', 'Android', 'iOS'];
        $deviceTypes = ['mobile', 'desktop', 'tablet'];

        $pages = [
            '/',
            '/berita',
            '/galeri',
            '/visi-misi',
            '/demografi',
            '/perangkat-desa',
            '/bumdes',
            '/pkk',
            '/posyandu',
            '/kontak',
            '/pengajuan-surat',
            '/berita/slug-berita-1',
            '/berita/slug-berita-2',
            '/berita/slug-berita-3',
            '/galeri/slug-galeri-1',
            '/galeri/slug-galeri-2',
        ];

        $referers = [
            'https://www.google.com',
            'https://www.facebook.com',
            'https://www.instagram.com',
            'https://twitter.com',
            null, // Direct traffic
            null,
            null,
        ];

        // Generate random date within last 30 days
        $date = Carbon::now()->subDays(rand(0, 30));

        return [
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'page_url' => url($this->faker->randomElement($pages)),
            'referer' => $this->faker->randomElement($referers),
            'device_type' => $this->faker->randomElement($deviceTypes),
            'browser' => $this->faker->randomElement($browsers),
            'platform' => $this->faker->randomElement($platforms),
            'visit_date' => $date->toDateString(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

    /**
     * Create visitor for specific date
     */
    public function forDate($date)
    {
        return $this->state(function (array $attributes) use ($date) {
            return [
                'visit_date' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        });
    }

    /**
     * Create mobile visitor
     */
    public function mobile()
    {
        return $this->state(function (array $attributes) {
            return [
                'device_type' => 'mobile',
                'platform' => $this->faker->randomElement(['Android', 'iOS']),
            ];
        });
    }

    /**
     * Create desktop visitor
     */
    public function desktop()
    {
        return $this->state(function (array $attributes) {
            return [
                'device_type' => 'desktop',
                'platform' => $this->faker->randomElement(['Windows', 'Mac OS', 'Linux']),
            ];
        });
    }
}
