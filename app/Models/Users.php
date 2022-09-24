<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{

    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'user_role',
        'profile_image',
        'name',
        'height',
        'weight',
        'email',
        'country_id',
        'city_id',
        'now_in',
        'mobile',
        'dob',
        'language_id',
        'currency_id',
        'app_notification',
        'points',
        'health_conditions',
        'mobile_code',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //    protected $casts = [
    //        'email_verified_at' => 'datetime',
    //    ];

}
