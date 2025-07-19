<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale_Detail extends Model
{
    protected $table = 'sale_details';

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
