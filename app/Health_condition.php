<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Health_condition extends Authenticatable
{

    protected $table = 'health_conditions';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name'
    ];
}
