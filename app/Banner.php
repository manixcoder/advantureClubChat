<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Banner extends Authenticatable
{

    protected $table = 'banners';
    public $timestamps = true;

    protected $fillable = [
        'banner',
        'title',
        'link',
        'status'
    ];
}
