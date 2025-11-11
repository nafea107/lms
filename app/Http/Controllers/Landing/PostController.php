<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display the specified post.
     */
    public function show($locale, Post $post)
    {
        // Check if post is published
        if (!$post->is_published) {
            abort(404);
        }

        return Inertia::render('Landing/PostDetail', [
            'post' => $post,
        ]);
    }
}
