<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_id',
        'attribute_id',
        'active',
        'restaurant_id'
        ];
}
