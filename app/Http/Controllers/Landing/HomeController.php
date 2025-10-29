<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // $courses = Course::with('lessons')->where('is_featured', true)->get();
        $subjects = Subject::all();

        // Get counts for stats
        $instructorsCount = Instructor::where('is_active', true)->count();
        $coursesCount = Course::count();
        // Count users with student role using Spatie's role package
        $studentsCount = User::role('student')->count();

        // Get experience years from settings
        $experienceYears = Setting::where('key', 'experience_years')->first()?->value ?? 0;
        
        // Get published posts ordered by order field
        $posts = Post::where('is_published', true)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return Inertia::render('Landing/Home', [
            'subjects' => $subjects,
            'posts' => $posts,
            'page' => Page::where('slug', 'home')->first(),
            'footerPage' => Page::where('slug', 'footer')->first(),
            'stats' => [
                'instructors' => $instructorsCount,
                'courses' => $coursesCount,
                'students' => $studentsCount,
                'experience' => $experienceYears
            ]
        ]);
    }
}
