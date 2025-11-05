<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'author', 'description'];
    
    protected $fillable = [
        'library_category_id',
        'title',
        'author',
        'description',
        'cover_image',
        'file_path',
    ];

    public function libraryCategory()
    {
        return $this->belongsTo(LibraryCategory::class);
    }
}
