<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Notification;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EnrollCourseController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/EnrollCourse/Index', [
            'users' => User::get(),
            'courses' => Course::get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $course = Course::find($request->course_id);
        Subscription::where('course_id', $request->course_id)->where('user_id', $request->user_id)->delete();
        Subscription::create([
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
        ]);
        Notification::create([
            'message' => [
                'ar' => 'تم الاشتراك بكورس ' . $course->getTranslation('name', 'ar'),
                'ku' => 'ناوت تۆمار کردووە بۆ خولێک ' . $course->getTranslation('name', 'ku'),
            ],
            'user_id' => auth()->id(),
        ]);
        return to_route('admin.home');
    }
}
