<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealAttributeOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_id',
        'meal_attribute_id',
        'option_id',
        'price',
        'active',
    ];
}
