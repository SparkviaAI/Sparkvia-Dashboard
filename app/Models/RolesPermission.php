<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Permission;


/**
 * Class RolesPermission
 * @package App\Models
 * @version June 21, 2022, 5:29 am UTC
 *
 * @property integer $role_id
 * @property integer $permission_id
 */
class RolesPermission extends Model
{
    use HasFactory;

    public $table = 'role_has_permissions';
    
    public $timestamps = false;
    protected $guard_name = 'web';

    public $fillable = [
        'role_id',
        'permission_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'role_id' => 'integer',
        'permission_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */

    public function roles(){
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function permissions(){
        return $this->hasOne(Permission::class,'id','permission_id');
    }
}

