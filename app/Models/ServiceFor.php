<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ServiceFor extends Authenticatable {

   
    protected $primaryKey = 'id';
	protected $table = 'service_for';
    protected $fillable = [
        'sfor', 
        'status'
    ];

}
