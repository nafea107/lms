<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InstructorController extends Controller
{
    /**
     * Display a listing of instructors.
     */
    public function index()
    {
        return Inertia::render('Landing/Instructors/Index');
    }

    /**
     * Display instructors by type (category).
     */
    public function byType($locale, $type)
    {
        // Validate type
        if (!in_array($type, ['future_leader', 'trainer'])) {
            abort(404);
        }

        $instructors = Instructor::where('is_active', true)
            ->where('type', $type)
            ->get();

        return Inertia::render('Landing/Instructors/ByType', [
            'instructors' => $instructors,
            'type' => $type,
        ]);
    }

    /**
     * Display the specified instructor.
     */
    public function show($locale, $slug)
    {
        $instructor = Instructor::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get courses taught by this instructor
        $courses = $instructor->courses()
            ->with('category')
            ->latest()
            ->get();

        return Inertia::render('Landing/Instructors/Show', [
            'instructor' => $instructor,
            'courses' => $courses,
        ]);
    }
}
