<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable=['name_ar', 'name_en', 'attribute_id', 'active','restaurant_id'];

    public function getNameAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class,'attribute_id')
            ->select('id','name_' . app()->getLocale() . '  as name','active');
    }
}
