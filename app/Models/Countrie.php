<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Countrie extends Authenticatable
{

    protected $fillable = [
        'country_id',
        'code',
        'phone_code',
        'country_name',
        'description',
        'country_status',
        'flag'
    ];
}
