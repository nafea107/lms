<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FavoriteCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FavoriteCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FavoriteCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FavoriteCourse whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FavoriteCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FavoriteCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FavoriteCourse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FavoriteCourse whereUserId($value)
 * @mixin \Eloquent
 */
class FavoriteCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id'
    ];

    /**
     * Get the user that owns the FavoriteCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the course that owns the FavoriteCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
