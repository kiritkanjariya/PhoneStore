<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'review', 'rating'];
}
