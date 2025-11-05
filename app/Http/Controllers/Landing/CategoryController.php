<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::mainCategories()
            ->with(['children' => function ($query) {
                $query->withCount('courses');
            }])
            ->withCount('courses')
            ->get();

        return response()->json($categories);
    }

    public function courses($locale, Category $category)
    {
        // Get courses for this category and all its subcategories
        $categoryIds = [$category->id];
        
        if ($category->children->count() > 0) {
            $categoryIds = array_merge($categoryIds, $category->children->pluck('id')->toArray());
        }

        $query = \App\Models\Course::whereIn('category_id', $categoryIds)
            ->with(['category', 'instructor'])
            ->isFav();

        $courses = $query->paginate(request('per_page', 12));

        // If it's an AJAX request, return JSON
        if (request()->wantsJson()) {
            return response()->json($courses);
        }

        // Otherwise, return Inertia view
        return Inertia::render('Landing/Categories/Courses', [
            'category' => $category,
            'categories' => Category::mainCategories()->with('children')->get(),
        ]);
    }
}
