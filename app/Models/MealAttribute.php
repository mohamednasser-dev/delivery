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

    public function meal_attribute_options()
    {
        return $this->HasMany(MealAttributeOption::class, 'meal_attribute_id');
    }
}
