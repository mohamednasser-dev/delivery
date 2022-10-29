<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name_ar',
        'name_en',
        'price',
        'active',
        'desc_ar',
        'desc_en',
        'position',
        'category_id',
        'status',
        'restaurant_id',
    ];
}
