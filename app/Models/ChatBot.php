<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Model;


class ChatBot extends Model implements HasMedia
{
    use SoftDeletes;
    use CascadeSoftDeletes;
    use HasFactory;
    use InteractsWithMedia;

    public $table = 'chat_bots';

    public const CHUNK_OF_WORDS = 200;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'files',
    ];

    protected $fillable = [
        'title',
        'text',
        'site_url',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFilesAttribute()
    {
        $files = $this->getMedia('files')->all();
        foreach ($files as $file) {
            $file->url = $file->getUrl();
        }

        return $files;
    }

    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class, 'chat_bot_id', 'id');
    }
}
