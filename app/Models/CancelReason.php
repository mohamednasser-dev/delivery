<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelReason extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if ( \app()->getLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function scopeActive($query): void
    {
        $query->where('active',1);
    }
}
