<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromptQuestion extends Model
{
    use HasFactory;

    public $table = 'prompt_question';

    protected $fillable = [
        'id',
        'prompt_id',
        'question_id',
        'order',
        'created_at',
        'updated_at',
    ];

}
