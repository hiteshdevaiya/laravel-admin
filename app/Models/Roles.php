<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
	use SoftDeletes;
	// protected $table='application_modules';
    protected $dates = ['deleted_at'];
}

?>