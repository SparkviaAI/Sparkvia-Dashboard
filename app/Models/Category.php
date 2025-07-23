<?php

namespace App\Models;

use App\Utils\Status;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Qirolab\Theme\Theme;
use App\Models\Theme as UserTheme;
use Spatie\Translatable\HasTranslations;

/**
 * @method static create(array $param)
 */
class Category extends Model
{
    use SoftDeletes;
    use CascadeSoftDeletes;
    use HasFactory;
    use HasTranslations;

    public $table = 'categories';

    public const TYPE_BLOG_TOOLS = 'Blog tools';
    public const TYPE_E_COMMERCE = 'E-Commerce';
    public const TYPE_SOCIAL_MEDIA_TOOLS = 'Social media tools';
    public const TYPE_DIGITAL_AD_COPY = 'Digital Ad copy';
    public const TYPE_BRAINSTORMING_TOOLS = 'Brainstorming tools';
    public const TYPE_PERSONAL_TOOLS = 'Personal tools';
    public const TYPE_IMAGES = 'Images';
    public const TYPE_STORYTELLING = 'Storytelling';


    protected $translatable = [
        'title'
    ];

    protected $cascadeDeletes = ['categoryPrompts'];

    public const STATUS_SELECT = [
        Status::ENABLED => 'Enabled',
        Status::DISABLED => 'Disabled',
    ];

    protected $casts = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function categoryPrompts(): HasMany
    {
        return $this->hasMany(Prompt::class, 'category_id', 'id');
    }

    public function scopeEnabled($query)
    {
        return $query->where('status', Status::ENABLED);
    }

    public function menuItem()
    {
        return $this->morphMany(MenuItem::class, 'linkable');
    }

    public function getLinkAttribute(): string
    {
        if (Theme::active() == strtolower(UserTheme::DEFAULT_THEME)) {
            return route_relative('frontend.home');
        }
        return route_relative('frontend.contents.items', ['category' => $this]);
    }

    public function scopeKeywords($query, $keyword)
    {
        if ($keyword) {
            $keyword = mb_strtolower($keyword);
            $query->where(
                DB::raw("CONCAT_WS('^' ,lower(title),  lower(status),id)"),
                'LIKE',
                "%$keyword%"
            );
        }
        return $query;
    }
}
