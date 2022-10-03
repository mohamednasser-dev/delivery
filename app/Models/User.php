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
    protected $fillable = [
        'name', 'email', 'password','address','phone','type','image','role_id','status','user_name','unique_name','main_lang',
        'api_token','college_id','gender','work_place','country_code','user_phone','is_new'
    ];
    protected $hidden =['password', 'remember_token','created_at','updated_at'];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    public function getImageAttribute($img)
    {
        if ($img)
            return asset('/uploads/users_images') . '/' . $img;
        else
            return "";
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
