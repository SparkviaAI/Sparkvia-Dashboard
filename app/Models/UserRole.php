<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'model_has_roles';
    const SUBADMIN=3;



    public $fillable = [
        'role_id',
        'model_type',
        'model_id'
    ];

    protected $casts = [
        'role_id' => 'integer',
        'model_type' => 'string',
        'model_id' => 'integer'
    ];


    public function roles(){
        return $this->hasOne(\App\Models\Role::class,'id','role_id');
    }


    public function users()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'model_id');
    }
    
}
