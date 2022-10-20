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
    protected $appends = ['name'];

    const STATUS_REJECTED = 'rejected';
    const STATUS_ACCEPTED = 'accepted';

    public function getNameAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
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


    public function getLogoAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/logos') . '/' . $image;
        }
        return asset('default-image.png');
    }

    public function setLogoAttribute($image)
    {
        if (is_file($image)) {
            $img_name = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/logos/'), $img_name);
            $this->attributes['logo'] = $img_name;
        } else {
            $this->attributes['logo'] = 'default-image.png';
        }
    }
}
