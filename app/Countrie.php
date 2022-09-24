<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Countrie extends Authenticatable
{
    protected $table = 'countries';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'country',
        'short_name',
        'code',
        'currency',
        'description',
        'status',
        'flag'
    ];
}
