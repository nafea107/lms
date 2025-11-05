<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LibraryCategory extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];
    
    protected $fillable = [
        'name',
        'color',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
