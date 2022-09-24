<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Question_report extends Authenticatable
{
    protected $fillable = [
        'username',
        'emailid',
        'mobile',
        'country',
        'purpose',
        'question'
    ];
}
