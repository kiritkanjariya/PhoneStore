<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    
    public function discount()
    {
        return $this->hasOne(Discount::class, 'product_id');
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
