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

    protected $appends=['name_ar', 'name_en'];
    protected $hidden=['created_at', 'updated_at'];

    protected function getNameArAttribute(){
        return $this->option()->first()->name_ar;
    }

    protected function getNameEnAttribute(){
        return $this->option()->first()->name_en;
    }

    public function option(){
        return $this->belongsTo(Option::class,"option_id");
    }
}
