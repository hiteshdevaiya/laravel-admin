<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccessModules extends Model
{
    use SoftDeletes;
    protected $table = 'user_access_modules';
}
