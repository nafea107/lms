<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Categories/Index');
    }


    public function data()
    {
        $items = Category::when(isset($_GET['search']), function ($query) {
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

        Category::create([
            'name' => request('name'),
        ]);

    }

    public function update(Request $request, $locale, Category $category)
    {
        $request->validate([
            'name.ku' => ['required', 'string', 'max:255'],
            'name.ar' => ['required', 'string', 'max:255'],
        ]);

        $category->update([
            'name' => request('name'),
        ]);


    }

    public function destroy($locale, Category $category)
    {
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Deleted Successfully'], 200);
        }
    }
}
