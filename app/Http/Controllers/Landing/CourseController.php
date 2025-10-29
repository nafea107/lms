<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\Subject;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request, $locale = null, $subject = null)
    {
        $subjectId = $subject ?? $request->subject;
        $query = Course::query()->with('category', 'level', 'instructor');

        if ($subjectId) {
            $query->where('subject_id', $subjectId);
        }

        $courses = $query->latest()->paginate(12);
        $subjects = Subject::all();
        $currentSubject = null;

        if ($subjectId) {
            $currentSubject = Subject::find($subjectId);
        }

        return Inertia::render('Landing/Courses/Index', [
            'courses' => $courses,
            'subjects' => $subjects,
            'currentSubject' => $currentSubject
        ]);
    }

    public function show($locale, Course $course)
    {
        if (auth()->user()->hasRole('admin')) {
            $isSubscribed = true;
        } else {
            $isSubscribed = Subscription::where('course_id', $course->id)->where('user_id', Auth::id())->exists();
        }
        $course->load('instructor');
        $this->loadCourseDataForNonSubscribers($course, $isSubscribed);
        return Inertia::render('Landing/Courses/Show', [
            'course' => $course,
        ]);
    }

    public function enroll($locale, Course $course)
    {
        $isSubscribed = Subscription::where('course_id', $course->id)->where('user_id', Auth::id())->exists();
        $course = $course->isFav()->whereId($course->id)->first();
        $course->load('instructor');
        $this->loadCourseDataForNonSubscribers($course, $isSubscribed);
        if ($isSubscribed) {
            return to_route('landing.courses.show', [
                'course' => $course,
            ]);
        }
        return Inertia::render('Landing/Courses/Enroll', [
            'course' => $course,
            'whatsapp' => Setting::whereKey('whatsapp')->first()
        ]);
    }

    private function loadCourseDataForNonSubscribers($course, $isSubscribed)
    {
        $course->setAttribute('is_subscribed', $isSubscribed);
        $course->load('chapters.lessons.quiz.questions');
        if ($course->price == 0 && !$isSubscribed) {
            Subscription::create(['course_id' => $course->id, 'user_id' => Auth::id()]);
        }
        if (!$isSubscribed) {
            $result = $course->chapters->map(function (Chapter $chapter) {
                $lessons = $chapter->lessons;

                // Modify each lesson
                return collect($lessons)->map(function (Lesson $lesson) {
                    $lesson->yt_url = null;
                    $lesson->file = null;

                    if (!$lesson->quiz?->questions) {
                        $lesson->setAttribute('quiz', null);
                    } else {
                        $lesson->quiz->setAttribute('questions', null);
                    }

                    return $lesson;
                });
            });

            // Flatten the result and return it
            $course->chapters = $result->flatten();
        }
    }
}
