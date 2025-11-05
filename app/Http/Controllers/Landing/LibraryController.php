<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\LibraryCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LibraryController extends Controller
{
    public function index($locale = null)
    {
        $categories = LibraryCategory::withCount('books')->get();
        
        return Inertia::render('Landing/Library/Index', [
            'categories' => $categories,
        ]);
    }

    public function byCategory($locale, $category)
    {
        $libraryCategory = LibraryCategory::findOrFail($category);
        $books = Book::where('library_category_id', $category)
            ->paginate(12);

        $categories = LibraryCategory::withCount('books')->get();

        return Inertia::render('Landing/Library/Category', [
            'books' => $books,
            'currentCategory' => $libraryCategory,
            'categories' => $categories,
        ]);
    }

    public function show($locale, Book $book)
    {
        $book->load('libraryCategory');
        
        return Inertia::render('Landing/Library/Show', [
            'book' => $book,
        ]);
    }
}
