<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LibraryCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Library/Books/Index');
    }

    public function data()
    {
        $items = Book::with('libraryCategory')->when(isset($_GET['search']), function ($query) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $_GET['search'] . '%')
                  ->orWhere('author', 'like', '%' . $_GET['search'] . '%');
            });
        })
            ->latest()
            ->paginate(25);

        $itemsArray = $items->toArray();
        $itemsArray['total_pages'] = $items->lastPage();

        return $itemsArray;
    }

    public function create()
    {
        return Inertia::render('Admin/Library/Books/Create', [
            'categories' => LibraryCategory::get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'library_category_id' => ['required', 'exists:library_categories,id'],
            'title.ku' => ['required', 'string', 'max:255'],
            'title.ar' => ['required', 'string', 'max:255'],
            'author.ku' => ['nullable', 'string', 'max:255'],
            'author.ar' => ['nullable', 'string', 'max:255'],
            'description.ku' => ['nullable', 'string'],
            'description.ar' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'file_path' => ['nullable', 'file', 'max:51200'], // 50MB max
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('/uploads/books/covers', 'public');
        }

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('/uploads/books/files', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index');
    }

    public function edit($locale, Book $book)
    {
        return Inertia::render('Admin/Library/Books/Edit', [
            'book' => $book,
            'categories' => LibraryCategory::get(),
        ]);
    }

    public function update(Request $request, $locale, Book $book)
    {
        $data = $request->validate([
            'library_category_id' => ['required', 'exists:library_categories,id'],
            'title.ku' => ['required', 'string', 'max:255'],
            'title.ar' => ['required', 'string', 'max:255'],
            'author.ku' => ['nullable', 'string', 'max:255'],
            'author.ar' => ['nullable', 'string', 'max:255'],
            'description.ku' => ['nullable', 'string'],
            'description.ar' => ['nullable', 'string'],
            'cover_image' => ['nullable'],
            'file_path' => ['nullable'],
        ]);

        if ($request->hasFile('cover_image')) {
            $request->validate([
                'cover_image' => 'image|max:4096'
            ]);
            if ($book->cover_image) {
                \Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('/uploads/books/covers', 'public');
        }

        if ($request->hasFile('file_path')) {
            $request->validate([
                'file_path' => 'file|max:51200'
            ]);
            if ($book->file_path) {
                \Storage::disk('public')->delete($book->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('/uploads/books/files', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index');
    }

    public function destroy($locale, Book $book)
    {
        if ($book) {
            if ($book->cover_image) {
                \Storage::disk('public')->delete($book->cover_image);
            }
            if ($book->file_path) {
                \Storage::disk('public')->delete($book->file_path);
            }
            $book->delete();
            return response()->json(['message' => 'Deleted Successfully'], 200);
        }
    }
}
