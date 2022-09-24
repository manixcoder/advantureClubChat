<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Activities extends Authenticatable {

    use SoftDeletes;
    protected $primaryKey = 'id';
	protected $table = 'activities';
    protected $fillable = [
        'activity', 
        'status'
    ];

}
