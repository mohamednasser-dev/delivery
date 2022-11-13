<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMeal extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at'];

    public function orderMealAttributes(){
        return $this->hasMany(OrderMealAttribute::class,'order_meal_id');
    }

    public function orderMealAddons(){
        return $this->hasMany(OrderMealAddons::class,'order_meal_id');
    }
}
