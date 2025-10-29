<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Posts/Index');
    }

    /**
     * Get posts data for the datatable.
     */
    public function data(Request $request)
    {
        $search = $request->search ?? '';
        $page = $request->page ?? 1;
        $perPage = 10;

        $query = Post::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(title, '$.ar') LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("JSON_EXTRACT(title, '$.ku') LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", ['%' . $search . '%']);
            });
        }

        $total = $query->count();
        $posts = $query->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        return [
            'data' => $posts,
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
            'title.ar' => 'required|string|max:255',
            'title.ku' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'content.ar' => 'required|string',
            'content.ku' => 'required|string',
            'content.en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['title', 'content', 'is_published', 'order']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts/images', 'public');
        }

        Post::create($data);

        return response()->json(['message' => 'Post created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, Post $post)
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $locale, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title.ar' => 'required|string|max:255',
            'title.ku' => 'required|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'content.ar' => 'required|string',
            'content.ku' => 'required|string',
            'content.en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->only(['title', 'content', 'is_published', 'order']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts/images', 'public');
        }

        $post->update($data);

        return response()->json(['message' => 'Post updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($locale, Post $post)
    {
        // Delete associated files
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
