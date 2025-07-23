<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Utils\Status;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $type
 */
class Prompt extends Model
{
    use SoftDeletes;
    use CascadeSoftDeletes;
    use HasFactory;
    use HasTranslations;

    public const TYPE_SELECT = [
        'text' => 'Text',
        'image' => 'Image',
    ];

    public const STATUS_SELECT = [
        Status::ENABLED => 'Enabled',
        Status::DISABLED => 'Disabled',
    ];

    public $table = 'prompts';

    protected $translatable = ['title', 'prompt', 'description'];

    protected $cascadeDeletes = ['promptContents'];

    protected $casts = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'prompt',
        'description',
        'max_tokens',
        'category_id',
        'engine_id',
        'type',
        'status',
        'chat_bot_id',
        'created_at',
        'created_by',
        'updated_at',
        'deleted_at',
    ];

    public function promptContents(): HasMany
    {
        return $this->hasMany(Content::class, 'prompt_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class)->withPivot('order')->orderBy('order', 'asc');
    }

    public function getIsImageAttribute(): bool
    {
        return $this->type == 'image';
    }

    public function getIsTextAttribute(): bool
    {
        return $this->type == 'text';
    }

    public function scopeEnabled($query)
    {
        return $query->where('status', Status::ENABLED);
    }

    public function engine(): BelongsTo
    {
        return $this->belongsTo(Engine::class, 'engine_id');
    }

    public function menuItem()
    {
        return $this->morphMany(MenuItem::class, 'linkable');
    }

    public function getLinkAttribute(): string
    {
        return route('tools.prompt.index', ['getPromptDetails' => $this]);
    }

    public function chatBot(): BelongsTo
    {
        return $this->belongsTo(ChatBot::class, 'chat_bot_id');
    }

    public function scopeKeywords($query, $keyword)
    {
        if ($keyword) {
            $keyword = mb_strtolower($keyword);
            $query->where(
                DB::raw("CONCAT_WS('^' ,lower(prompts.title),lower(categories.title)," .
                    " lower(type),prompts.id,prompts.status,max_tokens)"),
                'LIKE',
                "%$keyword%"
            );
        }
        return $query;
    }
}
