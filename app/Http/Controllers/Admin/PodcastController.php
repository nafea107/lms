<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PodcastController extends Controller
{
    public function data()
    {
        $items = Podcast::when(isset($_GET['search']), function ($query) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $_GET['search'] . '%')
                  ->orWhere('invitation_url', 'like', '%' . $_GET['search'] . '%');
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
        return Inertia::render('Admin/Podcasts/Index');
    }

    public function create()
    {
        return Inertia::render('Admin/Podcasts/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title.ar' => 'required_without:title.ku|string',
            'title.ku' => 'required_without:title.ar|nullable|string',
            'description.ar' => 'nullable|string',
            'description.ku' => 'nullable|string',
            'invitation_url' => 'required|url',
            'image' => 'nullable|image|max:4096',
            'scheduled_at' => 'nullable|date',
            'is_active' => 'required|boolean',
        ]);

        $data['title']['ar'] = $data['title']['ar'] ?? $data['title']['ku'];
        $data['title']['ku'] = $data['title']['ku'] ?? $data['title']['ar'];

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('/uploads', 'public');
        }

        Podcast::create($data);

        return to_route('admin.podcasts.index');
    }

    public function edit($locale, Podcast $podcast)
    {
        return Inertia::render('Admin/Podcasts/Edit', [
            'podcast' => $podcast,
        ]);
    }

    public function update(Request $request, $locale, Podcast $podcast)
    {
        $data = $request->validate([
            'title.ar' => 'required_without:title.ku|string',
            'title.ku' => 'required_without:title.ar|nullable|string',
            'description.ar' => 'nullable|string',
            'description.ku' => 'nullable|string',
            'invitation_url' => 'required|url',
            'image' => 'nullable',
            'scheduled_at' => 'nullable|date',
            'is_active' => 'required|boolean',
        ]);

        $data['title']['ar'] = $data['title']['ar'] ?? $data['title']['ku'];
        $data['title']['ku'] = $data['title']['ku'] ?? $data['title']['ar'];

        if (!is_string($request->image)) {
            $request->validate([
                'image' => 'image|max:4096'
            ]);
            if ($podcast->image) {
                \Storage::disk('public')->delete($podcast->image);
            }
            $data['image'] = $request->image->store('/uploads', 'public');
        }

        $podcast->update($data);

        return to_route('admin.podcasts.index');
    }

    public function destroy($locale, $id)
    {
        $podcast = Podcast::findOrFail($id);
        if ($podcast->image) {
            \Storage::disk('public')->delete($podcast->image);
        }
        $podcast->delete();
    }
}
