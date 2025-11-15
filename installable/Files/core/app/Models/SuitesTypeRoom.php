<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuitesTypeRoom extends Model
{
    protected $casts = [
        'items' => 'array'
    ];
}
