<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'target_id');
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'target_id');
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/offers') . '/' . $image;
        }
        return asset('defaults/default_category.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'offers_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/offers/'), $img_name);
            $this->attributes['image'] = $img_name;
        }
    }
}
