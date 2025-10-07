<?php
// database/seeders/VisitorLogSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorLog;
use Carbon\Carbon;

class VisitorLogSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('🌱 Generating visitor logs...');

        // Clear existing data (optional)
        VisitorLog::truncate();

        // Generate data for last 30 days
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            // Weekend vs weekday logic (lebih banyak di weekday)
            $isWeekend = $date->isWeekend();
            $baseVisitors = $isWeekend ? rand(50, 100) : rand(100, 200);

            // Trend naik ke hari ini
            $trendMultiplier = 1 + ((30 - $i) / 30) * 0.5; // +50% growth over 30 days
            $visitorsToday = (int) ($baseVisitors * $trendMultiplier);

            // Each visitor views multiple pages (1-5 pages per visitor)
            $totalPageViews = 0;

            $this->command->info("📅 Day -{$i}: Generating ~{$visitorsToday} visitors");

            for ($v = 0; $v < $visitorsToday; $v++) {
                $pagesPerVisitor = rand(1, 5);
                $totalPageViews += $pagesPerVisitor;

                // Same IP for this visitor's session
                $ipAddress = long2ip(rand(0, 4294967295));

                // Random device type for this visitor
                $deviceType = $this->getRandomDeviceType();
                $browser = $this->getRandomBrowser();
                $platform = $this->getRandomPlatform($deviceType);

                // Generate page views for this visitor
                $visitedPages = [];
                for ($p = 0; $p < $pagesPerVisitor; $p++) {
                    $page = $this->getRandomPage($visitedPages);
                    $visitedPages[] = $page;

                    // Add some time between page views
                    $visitTime = $date->copy()->addMinutes(rand(0, 1439)); // Random time in the day

                    VisitorLog::create([
                        'ip_address' => $ipAddress,
                        'user_agent' => $this->generateUserAgent($browser, $platform),
                        'page_url' => url($page),
                        'referer' => $p === 0 ? $this->getRandomReferer() : url($visitedPages[$p - 1]),
                        'device_type' => $deviceType,
                        'browser' => $browser,
                        'platform' => $platform,
                        'visit_date' => $visitTime->toDateString(),
                        'created_at' => $visitTime,
                        'updated_at' => $visitTime,
                    ]);
                }
            }

            $this->command->info("   ✅ Generated {$visitorsToday} visitors with {$totalPageViews} page views");
        }

        $totalVisitors = VisitorLog::distinct('ip_address')->count();
        $totalPageViews = VisitorLog::count();

        $this->command->info('');
        $this->command->info("✨ Done! Generated:");
        $this->command->info("   👥 {$totalVisitors} unique visitors");
        $this->command->info("   📄 {$totalPageViews} page views");
        $this->command->info("   📅 Over 30 days");
    }

    private function getRandomDeviceType()
    {
        // 60% mobile, 35% desktop, 5% tablet (realistic distribution)
        $rand = rand(1, 100);
        if ($rand <= 60) return 'mobile';
        if ($rand <= 95) return 'desktop';
        return 'tablet';
    }

    private function getRandomBrowser()
    {
        $browsers = [
            'Chrome' => 65,
            'Safari' => 15,
            'Firefox' => 10,
            'Edge' => 8,
            'Opera' => 2,
        ];

        $rand = rand(1, 100);
        $cumulative = 0;
        foreach ($browsers as $browser => $percentage) {
            $cumulative += $percentage;
            if ($rand <= $cumulative) {
                return $browser;
            }
        }
        return 'Chrome';
    }

    private function getRandomPlatform($deviceType)
    {
        if ($deviceType === 'mobile') {
            return rand(1, 100) <= 70 ? 'Android' : 'iOS';
        } elseif ($deviceType === 'tablet') {
            return rand(1, 100) <= 60 ? 'iOS' : 'Android';
        } else {
            $platforms = ['Windows' => 70, 'Mac OS' => 20, 'Linux' => 10];
            $rand = rand(1, 100);
            $cumulative = 0;
            foreach ($platforms as $platform => $percentage) {
                $cumulative += $percentage;
                if ($rand <= $cumulative) {
                    return $platform;
                }
            }
            return 'Windows';
        }
    }

    private function getRandomPage($excludePages = [])
    {
        $pages = [
            '/' => 30,
            '/berita' => 20,
            '/galeri' => 10,
            '/visi-misi' => 8,
            '/demografi' => 7,
            '/perangkat-desa' => 7,
            '/bumdes' => 5,
            '/pkk' => 5,
            '/posyandu' => 5,
            '/kontak' => 3,
            '/pengajuan-surat' => 10,
            '/berita/slug-berita-1' => 8,
            '/berita/slug-berita-2' => 6,
            '/berita/slug-berita-3' => 5,
            '/galeri/slug-galeri-1' => 4,
            '/galeri/slug-galeri-2' => 3,
        ];

        // Remove already visited pages
        foreach ($excludePages as $excludePage) {
            unset($pages[$excludePage]);
        }

        if (empty($pages)) {
            return '/';
        }

        $rand = rand(1, array_sum($pages));
        $cumulative = 0;
        foreach ($pages as $page => $weight) {
            $cumulative += $weight;
            if ($rand <= $cumulative) {
                return $page;
            }
        }
        return '/';
    }

    private function getRandomReferer()
    {
        $referers = [
            null => 40, // Direct traffic
            'https://www.google.com' => 30,
            'https://www.facebook.com' => 15,
            'https://www.instagram.com' => 10,
            'https://twitter.com' => 5,
        ];

        $rand = rand(1, 100);
        $cumulative = 0;
        foreach ($referers as $referer => $percentage) {
            $cumulative += $percentage;
            if ($rand <= $cumulative) {
                return $referer;
            }
        }
        return null;
    }

    private function generateUserAgent($browser, $platform)
    {
        $userAgents = [
            'Chrome-Windows' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Chrome-Mac OS' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Chrome-Android' => 'Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36',
            'Safari-iOS' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
            'Safari-Mac OS' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15',
            'Firefox-Windows' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0',
            'Edge-Windows' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0',
        ];

        $key = $browser . '-' . $platform;
        return $userAgents[$key] ?? $userAgents['Chrome-Windows'];
    }
}
