<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'pages';

    public const LANDING_PAGE = 'Landing Page';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'theme_id',
        'user_id',
        'tenant_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('order', 'asc');
    }
}
