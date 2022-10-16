<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = [''];
    protected $hidden = ['password'] ;

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function type()
    {
        return $this->belongsTo(RestaurantType::class, 'restaurant_type_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function owner_type()
    {
        return $this->belongsTo(OwnerType::class, 'owner_type_id');
    }
}
