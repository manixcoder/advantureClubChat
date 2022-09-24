<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Service extends Authenticatable
{

    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'name',
        'country',
        'service_sector',
        'service_category',
        'service_type',
        'service_level',
        'duration',
        'available_seats',
        'write_information',
        'service_for',
        'service_plan',
        'dependency_cond',
        'dependency_days',
        'geo_location',
        'specific_address',
        'cost_inc',
        'cost_exc',
        'prerequisites',
        'minimum_requirements',
        'terms_conditions',
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
