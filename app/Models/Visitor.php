<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_visited',
        'referrer',
        'country',
        'city',
        'device_type',
        'browser',
        'os',
        'is_unique',
        'visit_date',
        'visit_time'
    ];

    protected $casts = [
        'visit_date' => 'date',
        'visit_time' => 'datetime',
        'is_unique' => 'boolean'
    ];

    // Get today's unique visitors (unique IPs)
    public static function getTodayVisitors()
    {
        return self::where('visit_date', Carbon::today())
                   ->where('is_unique', true)
                   ->count();
    }

    // Get today's total visits (all page views, including repeated visits)
    public static function getTodayVisits()
    {
        return self::where('visit_date', Carbon::today())->count();
    }

    // Get unique visitors today
    public static function getTodayUniqueVisitors()
    {
        return self::where('visit_date', Carbon::today())
                   ->where('is_unique', true)
                   ->count();
    }

    // Get this week's visitors
    public static function getThisWeekVisitors()
    {
        return self::whereBetween('visit_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
    }

    // Get this month's visitors
    public static function getThisMonthVisitors()
    {
        return self::whereBetween('visit_date', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();
    }

    // Get visitors for the last 7 days for chart
    public static function getLast7DaysVisitors()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = self::where('visit_date', $date->format('Y-m-d'))->count();
            $data[] = [
                'date' => $date->format('M d'),
                'visitors' => $count
            ];
        }
        return $data;
    }

    // Get visitors for the last 30 days for chart
    public static function getLast30DaysVisitors()
    {
        $data = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = self::where('visit_date', $date->format('Y-m-d'))->count();
            $data[] = [
                'date' => $date->format('M d'),
                'visitors' => $count
            ];
        }
        return $data;
    }

    // Get top visited pages
    public static function getTopVisitedPages($limit = 10)
    {
        return self::selectRaw('page_visited, COUNT(*) as visit_count')
                   ->whereNotNull('page_visited')
                   ->groupBy('page_visited')
                   ->orderBy('visit_count', 'desc')
                   ->limit($limit)
                   ->get();
    }

    // Get device statistics
    public static function getDeviceStats()
    {
        return self::selectRaw('device_type, COUNT(*) as count')
                   ->whereNotNull('device_type')
                   ->groupBy('device_type')
                   ->get();
    }

    // Get browser statistics
    public static function getBrowserStats()
    {
        return self::selectRaw('browser, COUNT(*) as count')
                   ->whereNotNull('browser')
                   ->groupBy('browser')
                   ->orderBy('count', 'desc')
                   ->limit(5)
                   ->get();
    }

    // Get last year visitors (monthly data)
    public static function getLastYearVisitors()
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $visitors = self::whereYear('visit_date', $date->year)
                           ->whereMonth('visit_date', $date->month)
                           ->where('is_unique', true)
                           ->count();
            
            $data[] = [
                'date' => $date->format('M Y'),
                'visitors' => $visitors
            ];
        }
        return $data;
    }

    // Get last 5 years visitors (yearly data)
    public static function getLast5YearsVisitors()
    {
        $data = [];
        for ($i = 4; $i >= 0; $i--) {
            $date = Carbon::now()->subYears($i);
            $visitors = self::whereYear('visit_date', $date->year)
                           ->where('is_unique', true)
                           ->count();
            
            $data[] = [
                'date' => $date->format('Y'),
                'visitors' => $visitors
            ];
        }
        return $data;
    }

    // Get last 10 years visitors (yearly data)
    public static function getLast10YearsVisitors()
    {
        $data = [];
        for ($i = 9; $i >= 0; $i--) {
            $date = Carbon::now()->subYears($i);
            $visitors = self::whereYear('visit_date', $date->year)
                           ->where('is_unique', true)
                           ->count();
            
            $data[] = [
                'date' => $date->format('Y'),
                'visitors' => $visitors
            ];
        }
        return $data;
    }

    // Get all-time unique visitors (total unique visitors ever)
    public static function getAllTimeUniqueVisitors()
    {
        return self::where('is_unique', true)->count();
    }

    // Get all-time total visits (all page views ever)
    public static function getAllTimeTotalVisits()
    {
        return self::count();
    }
}
