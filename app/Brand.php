<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    public $timestamps = true;

    protected $fillable = array(
        'id',
        'brand_name',
        'status',
        'created_at',
        'updated_at'
    );
}
