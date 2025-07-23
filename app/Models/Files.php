<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    public $table = 'files';

    const TYPE_ADMIN = 1;
    const TYPE_USER = 2;


    //directory Name
    const FOLDER_ADMIN = "f_admin";
    const FOLDER_USER = "f_user";

    public $fillable = [
        'id', 
        'file_name', 
        'model_id', 
        'model_type', 
        'extension', 
        'file_size', 
        'view_count', 
        'status', 
        'type', 
        'created_by', 
        'deleted_at', 
        'created_at', 
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'file_name' => 'string',
        'model_id' => 'integer',
        'model_type' => 'integer',
        'extension' => 'string',
        'file_size' => 'string',
        'view_count' => 'integer',
        'status' => 'integer',
        'type' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'created_by');
    }

    public function jsonData()
    {
        $json = [];
        $json['id'] = $this->id;
        // $json['file_name'] = url('/file/') . '/' . $this->file_name;
        $json['file_name'] = route('download', array('type' => Files::TYPE_FILE, "file" => $this->file_name));
        $json['type'] = $this->type;
        return $json;
    }
}
