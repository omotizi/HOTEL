<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Guest extends Model {
    protected $appends = ['username'];

    public function username(): Attribute {
        return new Attribute(
            get: fn () => $this->name
        );
    }
}
