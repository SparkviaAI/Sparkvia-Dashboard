<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentSection extends Model
{
    use HasFactory;
    use HasTranslations;

    public $table = 'component_section';
    public $timestamps = false;

    protected $translatable = [
        'content',
    ];

    protected $fillable = [
        'section_id',
        'component_id',
        'content',
        'order'
    ];

    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
