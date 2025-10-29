<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Instructors/Index');
    }

    /**
     * Get instructors data for the datatable.
     */
    public function data(Request $request)
    {
        $search = $request->search ?? '';
        $page = $request->page ?? 1;
        $perPage = 10;

        $query = Instructor::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(name, '$.ar') LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("JSON_EXTRACT(name, '$.ku') LIKE ?", ['%' . $search . '%'])
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('specialty', 'like', '%' . $search . '%');
            });
        }

        $total = $query->count();
        $instructors = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return [
            'data' => $instructors,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'total_pages' => ceil($total / $perPage)
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name.ar' => 'required|string|max:255',
            'name.ku' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'specialty' => 'nullable|string|max:255',
            'bio.ar' => 'nullable|string',
            'bio.ku' => 'nullable|string',
            'qualifications.ar' => 'nullable|string',
            'qualifications.ku' => 'nullable|string',
            'experience.ar' => 'nullable|string',
            'experience.ku' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('image');

        // Generate slug if not provided
        if (!isset($data['slug']) || empty($data['slug'])) {
            $name = $data['name']['ar'] ?? $data['name']['ku'];
            $data['slug'] = Str::slug($name . '-' . uniqid());
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('instructors', 'public');
        }

        Instructor::create($data);

        return response()->json(['message' => 'Instructor created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, Instructor $instructor)
    {
        return response()->json($instructor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $locale, Instructor $instructor)
    {
        $validator = Validator::make($request->all(), [
            'name.ar' => 'required|string|max:255',
            'name.ku' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'specialty' => 'nullable|string|max:255',
            'bio.ar' => 'nullable|string',
            'bio.ku' => 'nullable|string',
            'qualifications.ar' => 'nullable|string',
            'qualifications.ku' => 'nullable|string',
            'experience.ar' => 'nullable|string',
            'experience.ku' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except(['image', '_method']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($instructor->image) {
                Storage::disk('public')->delete($instructor->image);
            }
            $data['image'] = $request->file('image')->store('instructors', 'public');
        }

        $instructor->update($data);

        return response()->json(['message' => 'Instructor updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Instructor $instructor)
    {
        // Delete associated image
        if ($instructor->image) {
            Storage::disk('public')->delete($instructor->image);
        }

        $instructor->delete();

        return response()->json(['message' => 'Instructor deleted successfully']);
    }
}
