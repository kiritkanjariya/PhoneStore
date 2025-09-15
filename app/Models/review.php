<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = ['user_id', 'product_id', 'review', 'rating'];
}
