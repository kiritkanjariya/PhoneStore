<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
