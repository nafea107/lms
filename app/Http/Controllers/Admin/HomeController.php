<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $courses_stats = [];
        foreach (range(0, 11) as $month) {
            $date = now()->subMonths($month);
            $subscription = Subscription::with('course')
                ->whereMonth('created_at', $date->month)
                ->select('course_id', \DB::raw('count(course_id) as count'))
                ->whereYear('created_at', $date->year)
                ->groupBy('course_id')
                ->orderBy('count', 'desc')
                ->first()?->toArray();
            $courses_stats[$month] = [
                'label' => @$subscription['course']['name'][app()->getLocale()] . " - " . $date->format('y/m'),
                'data' => $subscription['count'] ?? 0
            ];
        }

        $top_sale_courses = Subscription::with('course')
            ->select('course_id', \DB::raw('count(course_id) as count'))
            ->groupBy('course_id')
            ->orderBy('count', 'desc')
            ->limit(6)
            ->get();

        $courses_count = Course::count();
        $users_count = User::count();
        $subscriptions_count = Subscription::count();
        return Inertia::render('Admin/Home', compact('courses_stats', 'courses_count', 'top_sale_courses', 'users_count', 'subscriptions_count'));
    }
}
