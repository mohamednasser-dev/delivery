<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [''];
    protected $hidden = ['password'];
    protected $appends = ['name','description'];

    const STATUS_REJECTED = 'rejected';
    const STATUS_ACCEPTED = 'accepted';

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
        $section_ids = RestaurantSection::where('restaurant_id',$this->id)->pluck('section_id')->toArray();
        if (\app()->getLocale() == "ar") {
            if(empty($this->desc_ar))
                return implode(", ",Section::whereIn('id',$section_ids)->pluck('name_ar')->toArray());
            else
                return $this->desc_ar;
        } else {
            if(empty($this->desc_en))
                return implode(", ",Section::whereIn('id',$section_ids)->pluck('name_ar')->toArray());
            else
                return $this->desc_en;
        }
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = Hash::make($password);
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

    public function Categories()
    {
        return $this->HasMany(Category::class, 'restaurant_id');
    }

    public function sections()
    {
        return $this->HasMany(RestaurantSection::class, 'restaurant_id');
    }


    public function Meals()
    {
        return $this->HasMany(Meal::class, 'restaurant_id');
    }

    public function scopeAccepted($query): void
    {
        $query->where('status','accepted');
    }

    public function scopeActive($query): void
    {
        $query->where('active',1);
    }



    public function getLogoAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/logos') . '/' . $image;
        }
        return asset('defaults/default_restaurant.png');
    }

    public function setLogoAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'logo_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/logos/'), $img_name);
            $this->attributes['logo'] = $img_name;
        } else {
            $this->attributes['logo'] = 'default_restaurant.png';
        }
    }


    public function getCoverAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/covers') . '/' . $image;
        }
        return asset('defaults/default_category.png');
    }

    public function setCoverAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'cover_' . time() . random_int(0000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/covers/'), $img_name);
            $this->attributes['cover'] = $img_name;
        } else {
            $this->attributes['cover'] = 'default_category.png';
        }
    }

    public function reviews()
    {
        return $this->hasMany(RestaurantReview::class, 'restaurant_id')->accepted();
    }
}
