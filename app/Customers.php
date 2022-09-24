<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
    public $timestamps = true;

    protected $fillable = array(
        'id',
        'name',
        'card_purchaser_id',
        'card_link',
        'status',
        'created_at',
        'updated_at'
    );
}
