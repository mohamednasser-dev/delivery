<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $hidden = ['updated_at'];

    public function orderMeals(){
        return $this->hasMany(OrderMeal::class,'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id')
            ->select('id','name','phone');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
