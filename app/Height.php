<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Height extends Authenticatable
{
    protected $table = 'heights';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'hieghtName'
    ];
}
