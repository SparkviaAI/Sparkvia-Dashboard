<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $table = 'currencies';

    use HasFactory;

    public $fillable = [
        'name',
        'symbol',
        'alt_symbol',
        'icon',
        'type',
        'decimals',
        'status',
        'deposit_status',
        'withdraw_status',
        'deposit_fee',
        'withdraw_fee',
        'min_deposit',
        'max_deposit',
        'min_withdraw',
        'max_withdraw',
        'min_deposit_confirmation',
        'has_payment_id',
        'txn_explorer',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'deposit_status' => 'boolean',
        'withdraw_status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    const CARDANO = 1; 
    
}
