<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;


class CourseController extends Controller
{
    public function data()
    {
        $items = Course::with('instructor')->when(isset($_GET['search']), function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $_GET['search'] . '%');
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
        return Inertia::render('Admin/Courses/Index');
    }

    public function show($id) {}

    public function edit($locale, Course $course)
    {
        $course = $course->with('chapters')->firstOrFail();
        return Inertia::render('Admin/Courses/Edit', [
            'course' => $course,
            'levels' => Level::get(),
            'categories' => Category::get(),
            'subjects' => Subject::get(),
            'instructors' => Instructor::where('is_active', true)->get(),
        ]);
    }

    public function update(Request $request, $locale, Course $course)
    {
        $data = $request->validate([
            'name.ar' => 'required_without:name.ku|string',
            'name.ku' => 'required_without:name.ar|nullable|string',
            'description.ar' => 'required|string',
            'description.ku' => 'required|string',
            'level_id' => 'required|exists:App\Models\Level,id',
            'category_id' => 'required|exists:App\Models\Category,id',
            'chapters' => 'required|array|min:1',
            'chapters.*.name.ar' => 'required|string',
            'chapters.*.name.ku' => 'required|string',
            'price' => 'required|numeric',
            'is_featured' => 'required|boolean',
            'image' => 'required',
            'subject_id' => 'required|exists:App\Models\Subject,id',
            'instructor_id' => 'nullable|exists:App\Models\Instructor,id',
        ]);
        $data['name']['ar'] = $data['name']['ar'] ?? $data['name']['ku'];

        $data['name']['ku'] = $data['name']['ku'] ?? $data['name']['ar'];

        if (!is_string($request->image)) {
            $request->validate([
                'image' => 'image|max:4096'
            ]);
            \Storage::disk('public')->delete($course->image);
            $data['image'] = $request->image->store('/uploads', 'public');
        }
        $course->update($data);

        if (!empty($request->removed_chapters)) {
            Chapter::whereIn('id', $request->removed_chapters)->delete();
        }


        foreach ($data['chapters'] as $chapter) {
            if (isset($chapter['id'])) {
                $chapterModel = Chapter::find($chapter['id']);
                $chapterModel->update($chapter);
            } else {
                $course->chapters()->create($chapter);
            }
        }

        return to_route('admin.courses.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name.ar' => 'required_without:name.ku|string',
            'name.ku' => 'required_without:name.ar|nullable|string',
            'description.ar' => 'required|string',
            'description.ku' => 'required|string',
            'level_id' => 'required|exists:App\Models\Level,id',
            'category_id' => 'required|exists:App\Models\Category,id',
            'chapters' => 'required|array|min:1',
            'chapters.*.name.ar' => 'required|string',
            'chapters.*.name.ku' => 'required|string',
            'price' => 'required|numeric',
            'is_featured' => 'required|boolean',
            'image' => 'image|max:4096',
            'subject_id' => 'required|exists:App\Models\Subject,id',
            'instructor_id' => 'nullable|exists:App\Models\Instructor,id',
        ]);
        $data['name']['ar'] = $data['name']['ar'] ?? $data['name']['ku'];

        $data['name']['ku'] = $data['name']['ku'] ?? $data['name']['ar'];
        $data['image'] = $request->image->store('/uploads', 'public');

        $course = Course::create($data);
        $course->chapters()->createMany($data['chapters']);

        return to_route('admin.courses.index');
    }

    public function create()
    {
        return Inertia::render('Admin/Courses/Create', [
            'levels' => Level::get(),
            'categories' => Category::get(),
            'subjects' => Subject::get(),
            'instructors' => Instructor::where('is_active', true)->get(),
        ]);
    }

    public function destroy($locale, $id)
    {

        Course::where('id', $id)->delete();
    }
}
