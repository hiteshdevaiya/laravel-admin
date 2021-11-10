<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modules extends Model
{
    use SoftDeletes;
    // protected $table = 'roles';

    public function user_assigned_role(){
        return $this->hasOne('App\Models\User_assigned_role', 'user_role_id');
    }

    public function role_access_modules(){
        return $this->hasMany('App\Models\Role_access_modules','role_id');
    }
}
