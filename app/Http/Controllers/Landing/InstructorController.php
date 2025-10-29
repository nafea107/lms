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
        $instructors = Instructor::where('is_active', true)->get();

        return Inertia::render('Landing/Instructors/Index', [
            'instructors' => $instructors,
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
            ->with('category', 'level')
            ->latest()
            ->get();

        return Inertia::render('Landing/Instructors/Show', [
            'instructor' => $instructor,
            'courses' => $courses,
        ]);
    }
}
