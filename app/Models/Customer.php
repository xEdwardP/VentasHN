<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'document', 
        'name',
        'type',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }
}
