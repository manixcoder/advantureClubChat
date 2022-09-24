<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Service_sector extends Authenticatable
{

    use SoftDeletes;

    protected $fillable = [
        'sector',
        'status'
    ];
}
