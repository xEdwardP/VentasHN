<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

   
    protected $fillable = ['user_id', 'city_id', 'total'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
