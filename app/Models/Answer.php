<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * 
 *
 * @property int $id
 * @property array $answer
 * @property int $question_id
 * @property int $is_true
 * @property-read \App\Models\Question $question
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer whereIsTrue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Answer whereQuestionId($value)
 * @mixin \Eloquent
 */
class Answer extends Model
{
    use  HasTranslations;

    public $timestamps = false;
    public $translatable = ['answer'];
    protected $fillable = [
        'answer',
        'question_id',
        'is_true',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
