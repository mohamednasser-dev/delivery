<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens;

    protected $table = "customers";
    protected $guarded = [''];
    protected $hidden = ['password'];
    protected $appends = ['name'];

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = Hash::make($password);
        }
    }

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/Customer') . '/' . $image;
        }
        return asset('default-image.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/Customer/'), $img_name);
            $this->attributes['image'] = $img_name;
        } else {
            $this->attributes['image'] = 'default-image.png';
        }
    }
}
