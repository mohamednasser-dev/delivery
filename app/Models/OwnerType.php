<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerType extends Model
{
    protected $guarded = [''];
    protected $hidden = ['created_at','updated_at'];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if (\app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }
}
