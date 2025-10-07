<?php
// app/Http/Middleware/TrackVisitor.php (Versi Sederhana)

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\Log;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Jangan track jika dari admin area atau API
        if ($request->is('admin/*') || $request->is('api/*')) {
            return $next($request);
        }

        try {
            $userAgent = $request->userAgent();

            // Simple device detection
            $deviceType = 'desktop';
            if (preg_match('/mobile|android|iphone|ipad|phone/i', $userAgent)) {
                $deviceType = 'mobile';
            }

            // Simple browser detection
            $browser = 'Unknown';
            if (preg_match('/Chrome/i', $userAgent)) {
                $browser = 'Chrome';
            } elseif (preg_match('/Firefox/i', $userAgent)) {
                $browser = 'Firefox';
            } elseif (preg_match('/Safari/i', $userAgent)) {
                $browser = 'Safari';
            } elseif (preg_match('/Edge/i', $userAgent)) {
                $browser = 'Edge';
            }

            VisitorLog::create([
                'ip_address' => $request->ip(),
                'user_agent' => $userAgent,
                'page_url' => $request->fullUrl(),
                'referer' => $request->header('referer'),
                'device_type' => $deviceType,
                'browser' => $browser,
                'platform' => null,
                'visit_date' => now()->toDateString()
            ]);
        } catch (\Exception $e) {
            Log::error('Visitor tracking error: ' . $e->getMessage());
        }

        return $next($request);
    }
}
