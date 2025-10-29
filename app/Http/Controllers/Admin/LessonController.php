<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    private $roles = [
        'name.ar' => 'required|string',
        'name.ku' => 'required|string',
        'yt_url' => ['required', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/'],
        'course_id' => 'required|exists:App\Models\Course,id',
        'chapter_id' => 'required|exists:App\Models\Chapter,id',
        'quiz.name.ar' => 'required|string',
        'quiz.name.ku' => 'required|string',
        'quiz.question_and_answers' => 'array',
        'quiz.question_and_answers.*.question.ar' => 'required|string',
        'quiz.question_and_answers.*.question.ku' => 'required|string',
        'quiz.question_and_answers.*.answers.*.answer.ar' => 'required|string',
        'quiz.question_and_answers.*.answers.*.answer.ku' => 'required|string',
        'quiz.question_and_answers.*.answers.*.is_true' => 'boolean',
    ];

    public function data()
    {
        $items = Lesson::with('course')->when(isset($_GET['search']), function ($query) {
            $query->where(function (Builder $q) {
                $q->where('name', 'like', '%' . $_GET['search'] . '%')
                    ->orWhereHas('course', function (Builder $q) {
                        $q->where('name', 'like', '%' . $_GET['search'] . '%');
                    });
            });
        })
            ->latest()
            ->paginate(25);

        $itemsArray = $items->toArray();
        $itemsArray['total_pages'] = $items->lastPage();

        return $itemsArray;
    }

    public function index()
    {
        return Inertia::render('Admin/Lessons/Index');

    }

    public function show($locale, Lesson $lesson)
    {
    }

    public function edit($locale, Lesson $lesson)
    {
        $lesson = Lesson::where('id', $lesson->id)->with('quiz.questions.answers')->firstOrFail()?->toArray();
        return Inertia::render('Admin/Lessons/Edit', [
            'courses' => Course::with('chapters')->get(),
            'lesson' => $lesson
        ]);
    }

    public function update(Request $request, $locale, Lesson $lesson)
    {
        $roles = $this->roles;
        $roles['quiz.removed_question'] = 'array';
        $roles['quiz.removed_answers'] = 'array';
        $roles['quiz.question_and_answers.*.id'] = 'nullable';
        $roles['quiz.question_and_answers.*.answers.*.id'] = 'nullable';
        $data = $request->validate($roles, [
            'yt_url.regex' => __('validation.regex', ['attribute' => 'url'])
        ]);
        $data['img'] = $this->getYouTubeThumbnail($data['yt_url']);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:pdf,doc,docx,jpg,jpeg,png|max:20480',
            ]);
            if ($lesson->file) {
                \Storage::disk('public')->delete($lesson->file);
            }
            $data['file'] = $request->file('file')->store('/uploads', 'public');
        }

        $lesson->update($data);
        // validate that there is one true answer
        if ($data['quiz']['question_and_answers']) {
            foreach ($data['quiz']['question_and_answers'] as $qai => $question_and_answer) {
                $is_true_once = false;
                foreach ($question_and_answer['answers'] as $answer) {
                    $is_true_once = true;
                }
                if (!$is_true_once) {
                    return back()->withInput()->withErrors(["quiz.question_and_answers.{$qai}" => __('يجب تحديد اجابة واحدة صحيحة')]);
                }
            }

            // add quiz
            $quiz = $lesson->quiz;
            // add question_and_answers
            foreach ($data['quiz']['question_and_answers'] as $question_and_answer) {
                if (!isset($question_and_answer['id'])) {
                    $question = $quiz->questions()->create($question_and_answer);
                } else {
                    $question = $quiz->questions()->where('id', $question_and_answer['id'])->first();
                }

                foreach ($question_and_answer['answers'] as $answer) {
                    if (!isset($answer['id'])) {
                        $question->answers()->create($answer);
                    }
                }
            }
        }

        if (isset($data['quiz']['removed_questions'])) {
            Question::whereIn('id', $data['quiz']['removed_questions'])->delete();
        }

        if (isset($data['quiz']['removed_answers'])) {
            Answer::whereIn('id', $data['quiz']['removed_answers'])->delete();
        }


        return to_route('admin.lessons.index');
    }

    private function getYouTubeThumbnail($url)
    {
        // Parse the URL to extract the video ID
        preg_match("/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([^&\n]+)|youtu\.be\/([^&\n]+)/", $url, $matches);

        // Check if the video ID is found
        $videoID = !empty($matches[1]) ? $matches[1] : (isset($matches[2]) ? $matches[2] : null);

        if ($videoID) {
            // Return the URL for the thumbnail (default quality)
            return "https://img.youtube.com/vi/$videoID/0.jpg";
        } else {
            return null; // Invalid URL or video ID not found
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->roles, [
            'yt_url.regex' => __('validation.regex', ['attribute' => 'url'])
        ]);
        $data['img'] = $this->getYouTubeThumbnail($data['yt_url']);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:pdf,doc,docx,jpg,jpeg,png|max:20480',
            ]);
            $data['file'] = $request->file('file')->store('/uploads', 'public');
        }

        $lesson = Lesson::create($data);
        // validate that there is one true answer
        if (isset($data['quiz']['question_and_answers'])) {
            foreach ($data['quiz']['question_and_answers'] as $qai => $question_and_answer) {
                $is_true_once = false;
                foreach ($question_and_answer['answers'] as $answer) {
                    $is_true_once = true;
                }
                if (!$is_true_once) {
                    return back()->withInput()->withErrors(["quiz.question_and_answers.{$qai}" => __('يجب تحديد اجابة واحدة صحيحة')]);
                }
            }

            // add quiz
            $quiz = $lesson->quiz()->create([
                'name' => $data['quiz']['name'],
                'course_id' => $data['course_id'],
            ]);

            // add question_and_answers
            foreach ($data['quiz']['question_and_answers'] as $question_and_answer) {
                $question = $quiz->questions()->create($question_and_answer);
                foreach ($question_and_answer['answers'] as $answer) {
                    $question->answers()->create($answer);
                }
            }
        }

        return to_route('admin.lessons.index');
    }

    public function create()
    {
        return Inertia::render('Admin/Lessons/Create', [
            'courses' => Course::with('chapters')->get()
        ]);
    }

    public function destroy($locale, Lesson $lesson)
    {
        $lesson?->delete();

    }
}
