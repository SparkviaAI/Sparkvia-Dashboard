<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MenuItem extends Model
{
    use HasFactory;

    public $table = 'menu_items';
    public const CUSTOM = 'custom';

    protected $fillable = [
        'title',
        'linkable_id',
        'linkable_type',
        'target',
        'slug',
        'menu_id',
        'parent_id',
        'order'
    ];

    public function getIsCustomAttribute(): bool
    {
        return $this->linkable_type == self::CUSTOM;
    }

    public function getTypeAttribute(): string
    {
        return match ($this->linkable_type) {
            Prompt::class => trans('cruds.prompt.title'),
            Category::class => trans('cruds.contentCategory.title'),
            ContentPage::class => trans('cruds.contentPage.title'),
            default => trans('menu.custom_link')
        };
    }

    public function getCategoryAttribute(): string
    {
        return match ($this->linkable_type) {
            Prompt::class => 'prompt',
            Category::class => 'category',
            ContentPage::class => 'contentPage',
            default => 'custom_link'
        };
    }

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
}
