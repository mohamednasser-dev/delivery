<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMealAttribute extends Model
{
    use HasFactory;

    public function orderMealAttributeOptions(){
        return $this->hasMany(OrderMealAttributeOption::class,'meal_attribute_id');
    }
}
