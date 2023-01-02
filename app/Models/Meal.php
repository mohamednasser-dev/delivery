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

    protected $appends = ['name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, "restaurant_id");
    }

    public function getNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function getDescriptionAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->desc_ar;
        } else {
            return $this->desc_en;
        }
    }

    public function meal_attributes()
    {
        return $this->HasMany(MealAttribute::class, 'meal_id');
    }

    public function meal_addons()
    {
        return $this->HasMany(MealAddon::class, 'meal_id');
    }

    public function meal_categories()
    {
        return $this->HasMany(CategoryMeal::class,'meal_id');
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
            $img_name = 'meal_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/meals/'), $img_name);
            $this->attributes['image'] = $img_name;
        }
    }

    public function scopeActive($query): void
    {
        $query->where('active', 1);
    }

    public function scopeAccepted($query): void
    {
        $query->where('status', 'accepted');
    }
}
