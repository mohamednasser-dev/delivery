<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealAddon extends Model
{
    use HasFactory;

    protected $fillable=['addon_id', 'meal_id', 'active','price'];

}
