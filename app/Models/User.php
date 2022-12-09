<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;

    use HasRoles;

    protected $guarded = [''];
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/users_images') . '/' . $image;
        }
        return asset('defaults/user_default.png');
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $img_name = 'user_'.time() . random_int(0000,9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/users_images/'), $img_name);
            $this->attributes['image'] = $img_name;
        }
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function scopeUser($query)
    {
        $query->where('type', 'user');
    }

    public function scopeAdmin($query)
    {
        $query->where('type', 'admin');
    }
}
