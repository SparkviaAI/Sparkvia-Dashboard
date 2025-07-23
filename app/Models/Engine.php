<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Engine extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TEXT = 'text';
    public const CHAT = 'chat';

    public const GPT_35TURBO_16K = 'gpt-3.5-turbo-16k';
    public $table = 'engines';

    public const TYPE_SELECT = [
        self::TEXT => 'Text completion',
        self::CHAT => 'Chat completion',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'title',
        'value',
        'max_tokens',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getIsChatAttribute(): bool
    {
        return $this->type == self::CHAT;
    }
}
