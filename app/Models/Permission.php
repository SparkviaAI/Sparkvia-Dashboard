<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\RefreshesPermissionCache;


/**
 * Class Permission
 * @package App\Models
 * @version May 30, 2022, 12:41 pm UTC
 *
 * @property string $name
 */
class Permission extends Model
{

    use HasRoles;
    use RefreshesPermissionCache;
    use HasFactory;

    public $table = 'permissions';

    public $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'guard_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function roles(){
        return $this->hasOne(Role::class,'id','role_id');
    }
}

