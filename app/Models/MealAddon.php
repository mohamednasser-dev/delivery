<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealAddon extends Model
{
    use HasFactory;

    protected $fillable=['addon_id', 'meal_id', 'active','price'];
    protected $appends=['name_ar', 'name_en'];
    protected $hidden=['created_at', 'updated_at'];

    protected function getNameArAttribute(){
        return $this->addon()->first()->name_ar;
    }

    protected function getNameEnAttribute(){
        return $this->addon()->first()->name_en;
    }

    public function addon(){
        return $this->belongsTo(Addon::class,"addon_id");
    }


}
