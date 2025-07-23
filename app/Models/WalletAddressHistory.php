<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Currency;
use App\Models\Coin;
use App\Models\User;

class WalletAddressHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'is_encrypted', 'currency_id', 'wallet_id', 'address', 'coin_type', 'wallet_key', 'public_key', 'created_at', 'updated_at', 'memo'
    ];

    public function wallet(){
        return $this->hasOne(Wallet::class,'id','wallet_id');
    }
    
    public function currency()
    {
        return $this->hasOne(Currency::class,'id','coin_id');
    }
    
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
