<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminWalletKey extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'uid', 'network_id', 'address', 'pv', 'creation_type', 'status', 'created_at', 'updated_at'
    ];

}
