<?php
// app/Models/VisitorLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VisitorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_url',
        'referer',
        'device_type',
        'browser',
        'platform',
        'visit_date'
    ];

    protected $casts = [
        'visit_date' => 'date'
    ];

    /**
     * Get total unique visitors
     */
    public static function getTotalUniqueVisitors()
    {
        return self::distinct('ip_address')->count('ip_address');
    }

    /**
     * Get total page views
     */
    public static function getTotalPageViews()
    {
        return self::count();
    }

    /**
     * Get visitors today
     */
    public static function getVisitorsToday()
    {
        return self::whereDate('visit_date', today())
            ->distinct('ip_address')
            ->count('ip_address');
    }

    /**
     * Get page views today
     */
    public static function getPageViewsToday()
    {
        return self::whereDate('visit_date', today())->count();
    }

    /**
     * Get visitors this month
     */
    public static function getVisitorsThisMonth()
    {
        return self::whereMonth('visit_date', now()->month)
            ->whereYear('visit_date', now()->year)
            ->distinct('ip_address')
            ->count('ip_address');
    }

    /**
     * Get page views this month
     */
    public static function getPageViewsThisMonth()
    {
        return self::whereMonth('visit_date', now()->month)
            ->whereYear('visit_date', now()->year)
            ->count();
    }

    /**
     * Get visitor trend for last N days
     */
    public static function getVisitorTrend($days = 7)
    {
        $trend = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $visitors = self::whereDate('visit_date', $date)
                ->distinct('ip_address')
                ->count('ip_address');
            $pageViews = self::whereDate('visit_date', $date)->count();

            $trend[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d/m'),
                'visitors' => $visitors,
                'page_views' => $pageViews
            ];
        }
        return $trend;
    }

    /**
     * Get most visited pages
     */
    public static function getMostVisitedPages($limit = 10)
    {
        return self::selectRaw('page_url, COUNT(*) as views')
            ->groupBy('page_url')
            ->orderBy('views', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get device statistics
     */
    public static function getDeviceStats()
    {
        return self::selectRaw('device_type, COUNT(*) as count')
            ->whereNotNull('device_type')
            ->groupBy('device_type')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->device_type => $item->count];
            });
    }

    /**
     * Get browser statistics
     */
    public static function getBrowserStats($limit = 5)
    {
        return self::selectRaw('browser, COUNT(*) as count')
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderBy('count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Calculate growth percentage
     */
    public static function calculateGrowth()
    {
        $currentMonth = self::whereMonth('visit_date', now()->month)
            ->whereYear('visit_date', now()->year)
            ->distinct('ip_address')
            ->count('ip_address');

        $previousMonth = self::whereMonth('visit_date', now()->subMonth()->month)
            ->whereYear('visit_date', now()->subMonth()->year)
            ->distinct('ip_address')
            ->count('ip_address');

        if ($previousMonth == 0) {
            return $currentMonth > 0 ? 100 : 0;
        }

        return round((($currentMonth - $previousMonth) / $previousMonth) * 100, 1);
    }
}
