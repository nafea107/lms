<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LevelController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Levels/Index');
    }


    public function data()
    {
        $items = Level::when(isset($_GET['search']), function ($query) {
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

    public function store(Request $request)
    {
        $request->validate([
            'name.ku' => ['required', 'string', 'max:255'],
            'name.ar' => ['required', 'string', 'max:255'],
        ]);

        Level::create([
            'name' => request('name'),
        ]);

    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'name.ku' => ['required', 'string', 'max:255'],
            'name.ar' => ['required', 'string', 'max:255'],
        ]);

        $level->update([
            'name' => request('name'),
        ]);

    }

    public function destroy($locale, Level $level)
    {
        if ($level) {
            $level->delete();
            return response()->json(['message' => 'Deleted Successfully'], 200);
        }
    }
}
