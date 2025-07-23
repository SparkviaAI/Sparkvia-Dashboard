<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'themes';
    public const DEFAULT_THEME = 'Front';
    public const SILICON_THEME = 'Silicon';
    public const LIGHT = 'light';
    public const DARK = 'dark';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class, 'theme_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('order', 'asc');
    }
}
