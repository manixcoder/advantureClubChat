<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contactuspurpose extends Authenticatable{

    protected $fillable = [
        'id', 
        'contactuspurposeName'
    ];

}
