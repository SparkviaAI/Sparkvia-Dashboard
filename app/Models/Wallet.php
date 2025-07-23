<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public $table = 'wallets';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'currency_id',
        'balance_in_wallet',
        'balance_in_order',
        'balance_in_withdraw',
        'created_at',
        'updated_at',
    ];


    public function rUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

}
