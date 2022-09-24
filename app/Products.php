<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public $timestamps = true;

    protected $fillable = array(
        'id',
        'brand_id',
        'category_id',
        'product_name',
        'product_price',
        'inventory',
        'description',
        'status',
        'created_at',
        'updated_at'
    );
}
