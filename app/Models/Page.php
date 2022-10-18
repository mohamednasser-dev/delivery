<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['type_text'];
    public function getTitleAttribute()
    {
        if ($locale = \app()->getLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }
    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/pages') . '/' . $image;
        }
        return asset('default-image.png');
    }
    public function getTypeTextAttribute()
    {
        if ($this->type == 'about') {
            return 'عن التطبيق';
        } elseif ($this->type == 'idea') {
            return 'عن 80 فكرة';
        }elseif ($this->type == 'privacy') {
            return 'سياسة الخصوصية';
        }elseif ($this->type == 'terms') {
            return 'الشروط والاحكام';
        }elseif ($this->type == 'call_us') {
            return 'اتصل بنا';
        }
    }

//    public function setImageAttribute($image)
//    {
//        if (is_file($image)) {
//            $img_name = time() . uniqid() . '.' . $image->getClientOriginalExtension();
//            $image->move(public_path('/uploads/pages/'), $img_name);
//            $this->attributes['image'] = $img_name;
//        } else {
//            $this->attributes['image'] = $image;
//        }
//    }
}
