<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Otp extends Authenticatable
{
    use Notifiable;

    protected $table = 'otp';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'type',
        'otp',
        'expire',
        'status'
    ];
}
