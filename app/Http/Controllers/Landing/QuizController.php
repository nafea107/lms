<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Setting;
use App\Models\Subscription;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function show($locale, Quiz $quiz)
    {
        $isSubscribed = Subscription::where('course_id', $quiz->course_id)->where('user_id', auth()->id())->exists();
        $whatsapp = Setting::where('key', 'whatsapp')->first()?->value;

        if (!$isSubscribed) {
            abort(403, " {$whatsapp} " . __('اشترك لمشاهدة الكورس عن طريق واتساب'));
        }

        $quiz->load('questions.answers');
        return Inertia::render('Landing/Quizzes/Show', [
            'quiz' => $quiz,
        ]);
    }
}
