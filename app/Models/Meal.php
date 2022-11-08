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

    public function meal_attributes()
    {
        return $this->HasMany(MealAttribute::class, 'meal_id');
    }

    public function meal_addons()
    {
        return $this->HasMany(MealAddon::class, 'meal_id');
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/meals') . '/' . $image;
        }
        return asset('defaults/default_meal.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/meals/'), $img_name);
            $this->attributes['image'] = $img_name;
        }
    }
}
