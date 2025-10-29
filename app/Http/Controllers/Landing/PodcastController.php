<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::where('is_active', true)
            ->orderBy('scheduled_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return Inertia::render('Landing/Podcasts/Index', [
            'podcasts' => $podcasts,
        ]);
    }
}
