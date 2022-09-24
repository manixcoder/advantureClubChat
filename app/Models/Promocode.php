<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Promocode extends Authenticatable
{

    use SoftDeletes;
    use Notifiable;

    public $table = 'promocode';

    protected $fillable = [
        'promocode_name',
        'code',
        'status',
        'discount_type',
        'discount_amount',
        'redeemed_count',
        'start_date',
        'end_date',
        'description',
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
