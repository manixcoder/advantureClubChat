<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Aimed extends Authenticatable {

    use SoftDeletes;
    protected $table = 'aimed';
     protected $primaryKey = 'id';
    protected $fillable = [
        'AimedName',
        'created_at',
        'updated_at'
    ];

}
