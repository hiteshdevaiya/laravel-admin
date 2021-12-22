<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
	use SoftDeletes;
	protected $table='status';
    // protected $dates = ['deleted_at'];
}

?>