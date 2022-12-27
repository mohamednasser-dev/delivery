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
        'restaurant_id',
        "min_choice",
        "max_choice",
        ];

    protected $appends=['name_ar', 'name_en'];
    protected $hidden=['created_at', 'updated_at','restaurant_id'];

    protected function getNameArAttribute(){
        return $this->attribute()->first()->name_ar;
    }

    protected function getNameEnAttribute(){
        return $this->attribute()->first()->name_en;
    }

    public function attribute(){
        return $this->belongsTo(Attribute::class,"attribute_id");
    }

    public function meal_attribute_options()
    {
        return $this->HasMany(MealAttributeOption::class, 'meal_attribute_id');
    }
}
