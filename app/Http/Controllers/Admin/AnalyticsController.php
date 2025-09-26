<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        $data = [
            'today_visits' => Visitor::getTodayVisits(),
            'today_unique_visitors' => Visitor::getTodayVisitors(),
            'this_week_visitors' => Visitor::getThisWeekVisitors(),
            'this_month_visitors' => Visitor::getThisMonthVisitors(),
            'all_time_unique_visitors' => Visitor::getAllTimeUniqueVisitors(),
            'all_time_total_visits' => Visitor::getAllTimeTotalVisits(),
            'last_7_days' => Visitor::getLast7DaysVisitors(),
            'last_30_days' => Visitor::getLast30DaysVisitors(),
            'top_pages' => Visitor::getTopVisitedPages(10),
            'device_stats' => Visitor::getDeviceStats(),
            'browser_stats' => Visitor::getBrowserStats(),
        ];

        return view('backend.analytics.index', $data);
    }

    public function getChartData(Request $request)
    {
        $period = $request->get('period', '7days');
        
        switch ($period) {
            case '7days':
                $data = Visitor::getLast7DaysVisitors();
                break;
            case '30days':
                $data = Visitor::getLast30DaysVisitors();
                break;
            case '1year':
                $data = Visitor::getLastYearVisitors();
                break;
            case '5years':
                $data = Visitor::getLast5YearsVisitors();
                break;
            case '10years':
                $data = Visitor::getLast10YearsVisitors();
                break;
            default:
                $data = Visitor::getLast7DaysVisitors();
        }

        return response()->json($data);
    }

    public function getVisitorStats()
    {
        $stats = [
            'today' => [
                'total' => Visitor::getTodayVisitors(),
                'unique' => Visitor::getTodayUniqueVisitors()
            ],
            'week' => [
                'total' => Visitor::getThisWeekVisitors()
            ],
            'month' => [
                'total' => Visitor::getThisMonthVisitors()
            ],
            'all_time' => [
                'total' => Visitor::getAllTimeTotalVisits(),
                'unique' => Visitor::getAllTimeUniqueVisitors()
            ]
        ];

        return response()->json($stats);
    }

    public function initialize()
    {
        try {
            // Clear ALL existing visitor data
            Visitor::truncate();

            return response()->json([
                'success' => true,
                'message' => 'Analytics system reset successfully! All data cleared. New visits will be tracked from now.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error resetting analytics: ' . $e->getMessage()
            ]);
        }
    }
}
