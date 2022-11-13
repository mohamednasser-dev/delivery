<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMealAttribute extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at'];

    public function orderMealAttributeOptions(){
        return $this->hasMany(OrderMealAttributeOption::class,'order_meal_attribute_id');
    }
}
