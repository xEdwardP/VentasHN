<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
