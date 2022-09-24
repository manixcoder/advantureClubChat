<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cardactivity extends Model
{
    protected $table = 'card_activity';
    public $timestamps = true;

    protected $fillable = array(
        'id',
        'customer_id',
        'date',
        'card_purchase_id',
        'card_link',
        'created_at',
        'updated_at'
    );
}
