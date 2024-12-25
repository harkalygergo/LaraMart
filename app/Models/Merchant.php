<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Merchant extends Authenticatable
{
    private ?string $last_activity;

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
