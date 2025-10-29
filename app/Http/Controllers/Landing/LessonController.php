<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\Subscription;
use Inertia\Inertia;

class LessonController extends Controller
{
    public function show($locale, Lesson $lesson)
    {
        if (auth()->user()->hasRole('admin')) {
            $isSubscribed = true;
        } else {
            $isSubscribed = Subscription::where('course_id', $lesson->course_id)->where('user_id', auth()->id())->exists();
        }
        $whatsapp = Setting::where('key', 'whatsapp')->first()?->value;
        $course = Course::where('id', $lesson->course_id)->first();
        if (!$isSubscribed) {
            if ($course->price == 0) {
                Subscription::create(['course_id' => $course->id, 'user_id' => auth()->id()]);
                Notification::create([
                    'message' => [
                        'ar' => 'تم الاشتراك بكورس ' . $course->getTranslation('name', 'ar'),
                        'ku' => 'ناوت تۆمار کردووە بۆ خولێک ' . $course->getTranslation('name', 'ku'),
                    ],
                    'user_id' => auth()->id(),
                ]);
            } else {

                return to_route('landing.courses.enroll', [
                    'course' => $course,
                ]);
            }
        }

        $course->setAttribute('is_subscribed', $isSubscribed);
        $course->load('chapters.lessons.quiz.questions');


        return Inertia::render('Landing/Lessons/Show', [
            'lesson' => $lesson,
            'course' => $course,
        ]);
    }
}
