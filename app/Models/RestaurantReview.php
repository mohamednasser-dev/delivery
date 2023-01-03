<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = ['pending', 'accepted', 'rejected'];

    protected $appends = ['status_text'];

    public function getStatusTextAttribute()
    {
        if ($this->status == 'accepted') {
            return trans('lang.accepted');
        } elseif ($this->status == 'rejected') {
            return trans('lang.rejected');
        } elseif ($this->status == 'pending') {
            return trans('lang.pending');
        }
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

}
