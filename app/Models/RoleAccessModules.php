<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleAccessModules extends Model
{
    use SoftDeletes;
    protected $table = 'role_access_modules';
    protected $dates = ['deleted_at'];
}
