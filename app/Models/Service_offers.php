<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Service_offers extends Authenticatable
{

    use SoftDeletes;

    protected $fillable = [
        'service_id',
        'name',
        'start_date',
        'end_date',
        'discount_type',
        'discount_amount',
        'banner',
        'description',
        'status',
        'deleted_at'
    ];
}
