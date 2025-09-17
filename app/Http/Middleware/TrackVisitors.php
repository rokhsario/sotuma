<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tracking for admin routes and API routes
        if ($request->is('admin/*') || $request->is('api/*') || $request->is('_debugbar/*')) {
            return $next($request);
        }

        try {
            $agent = new Agent();
            $ip = $request->ip();
            $userAgent = $request->userAgent();
            $page = $request->path();
            $referrer = $request->header('referer');
            
            // Check if this is a unique visit (same IP, same day)
            $isUnique = !Visitor::where('ip_address', $ip)
                               ->where('visit_date', Carbon::today())
                               ->exists();

            // Determine device type
            $deviceType = 'desktop';
            if ($agent->isMobile()) {
                $deviceType = 'mobile';
            } elseif ($agent->isTablet()) {
                $deviceType = 'tablet';
            }

            // Get browser and OS
            $browser = $agent->browser();
            $os = $agent->platform();

            // Create visitor record
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'page_visited' => $page,
                'referrer' => $referrer,
                'device_type' => $deviceType,
                'browser' => $browser,
                'os' => $os,
                'is_unique' => $isUnique,
                'visit_date' => Carbon::today(),
                'visit_time' => Carbon::now()
            ]);

        } catch (\Exception $e) {
            // Log error but don't break the application
            \Log::error('Visitor tracking error: ' . $e->getMessage());
        }

        return $next($request);
    }
}
