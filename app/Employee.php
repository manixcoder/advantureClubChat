<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{

	protected $primaryKey = 'id';
	protected $table = 'employees';
	public $timestamps = true;
}
