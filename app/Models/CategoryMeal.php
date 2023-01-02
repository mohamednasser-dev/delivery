<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMeal extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $appends = ['category_name', 'meal_name'];

    public function getCategoryNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->category()->first()->name_ar;
        } else {
            return $this->category()->first()->name_en;
        }
    }

    public function getMealNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->meal()->first()->name_ar;
        } else {
            return $this->meal()->first()->name_en;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class, "meal_id");
    }
}
