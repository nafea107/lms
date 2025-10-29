<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property array<array-key, mixed> $name
 * @property array<array-key, mixed>|null $bio
 * @property string|null $image
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $specialty
 * @property array<array-key, mixed>|null $qualifications
 * @property array<array-key, mixed>|null $experience
 * @property string|null $facebook_url
 * @property string|null $twitter_url
 * @property string|null $linkedin_url
 * @property string|null $instagram_url
 * @property string $slug
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $courses
 * @property-read int|null $courses_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereFacebookUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereInstagramUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereLinkedinUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereQualifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereSpecialty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereTwitterUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
