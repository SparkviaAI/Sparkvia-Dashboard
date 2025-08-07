<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XrpConversionRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'xrp_amount', 'sparks_amount', 'status', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'xrp_amount' => 'decimal:6',
    ];
}
