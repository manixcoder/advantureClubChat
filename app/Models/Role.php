<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Role extends Authenticatable {

    use SoftDeletes;

    protected $fillable = [
        'country_id','role_id','sort'
    ];

}
