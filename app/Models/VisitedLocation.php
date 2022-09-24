<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VisitedLocation extends Authenticatable
{

    use SoftDeletes;
    protected $table = 'visited_location';
    protected $primaryKey = 'id';

    protected $fillable = [
       'id',
       'user_id',
       'destination_image',
       'destination_name',
       'destination_type',
       'geo_location',
       'destination_address',
       'dest_mobile',
       'dest_website',
       'dest_description',
       'is_approved',
       'created_at',
       'updated_at',
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
