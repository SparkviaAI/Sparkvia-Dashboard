<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;

    public const SEPARATOR = ';';
    public const IS_REQUIRED_SELECT = [
        'required' => 'Required',
        'optional' => 'Optional',
    ];
    public const SINGLE_LINE = 'single_line';
    public const MULTI_LINE = 'multi_line';
    public const SINGLE_SELECT = 'single_select';
    public const LIVE_CRAWLING = 'live_crawling';

    public const TYPE_SELECT = [
        self::SINGLE_LINE => 'Single Line',
        self::MULTI_LINE => 'Multi Line',
        self::SINGLE_SELECT => 'Select',
        self::LIVE_CRAWLING => 'Live Crawling',
    ];

    public $table = 'questions';

    protected $translatable = ['question'];

    protected $casts = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'question',
        'type',
        'is_required',
        'minimum_answer_length',
        'options',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function prompts(): BelongsToMany
    {
        return $this->belongsToMany(Prompt::class);
    }

    public function getOptionsAttribute(): array
    {
        if ($this->attributes['options']) {
            return explode(self::SEPARATOR, $this->attributes['options']);
        }

        return [];
    }

    public function setOptionsAttribute(array $values): void
    {
        $this->attributes['options'] = empty($values) ? null : implode(self::SEPARATOR, $values);
    }

    public function scopeKeywords($query, $keyword)
    {
        if ($keyword) {
            $keyword = mb_strtolower($keyword);
            $query->where(
                DB::raw("CONCAT_WS('^' ,lower(question),  lower(type), id, is_required, minimum_answer_length)"),
                'LIKE',
                "%$keyword%"
            );
        }
        return $query;
    }
}

