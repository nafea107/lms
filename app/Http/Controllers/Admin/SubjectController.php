<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Subjects/Index');
    }

    /**
     * Get subjects data for the datatable.
     */
    public function data(Request $request)
    {
        $search = $request->search ?? '';
        $page = $request->page ?? 1;
        $perPage = 10;

        $query = Subject::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(name, '$.ar') LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("JSON_EXTRACT(name, '$.ku') LIKE ?", ['%' . $search . '%']);
            });
        }

        $total = $query->count();
        $subjects = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return [
            'data' => $subjects,
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['name', 'background']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('subjects/images', 'public');
        }

        Subject::create($data);

        return response()->json(['message' => 'Subject created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, Subject $subject)
    {
        return response()->json($subject);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($locale, Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $locale, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'name.ar' => 'required|string|max:255',
            'name.ku' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['name', 'background']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($subject->image) {
                Storage::disk('public')->delete($subject->image);
            }
            $data['image'] = $request->file('image')->store('subjects/images', 'public');
        }

        $subject->update($data);

        return response()->json(['message' => 'Subject updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Subject $subject)
    {
        // Delete associated files
        if ($subject->image) {
            Storage::disk('public')->delete($subject->image);
        }

        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
