<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Instructor extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'bio', 'qualifications', 'experience'];

    protected $fillable = [
        'name',
        'bio',
        'image',
        'email',
        'phone',
        'specialty',
        'qualifications',
        'experience',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'slug',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Generate a slug from the name
    public static function boot()
    {
        parent::boot();

        static::creating(function ($instructor) {
            if (empty($instructor->slug)) {
                $name = $instructor->getTranslation('name', 'en') ?? $instructor->getTranslation('name', 'ar');
                $instructor->slug = \Str::slug($name . '-' . uniqid());
            }
        });
    }

    // Courses taught by this instructor
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
