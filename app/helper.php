<?php

use App\Models\Setting;

if (!function_exists('restaurant')) {
    function restaurant()
    {
        return auth('sanctum')->user();
    }
}

if (!function_exists('new_reviews')) {
    function new_reviews()
    {
        return \App\Models\RestaurantReview::where('status', 'pending')->get()->count();
    }
}

if (!function_exists('customer')) {
    function customer()
    {
        return auth('sanctum')->user();
    }
}

if (!function_exists('pagination_number')) {
    function pagination_number()
    {
        return 10;
    }
}



if (!function_exists('auths')) {
    function auths()
    {
        if (auth('web')->check()) {
            return auth('web')->user();
        }
    }
}
if (!function_exists('currency')) {
    function currency()
    {
        $result = Setting::where('key', 'currency_' . app()->getLocale())->first();
        if ($result) {
            return $result->val;
        } else {
            return 'ر.س';
        }
    }
}

if (!function_exists('upload')) {
    function upload($file, $dir)
    {
        $image = time() . random_int(0000,9999) . '.' . $file->getClientOriginalExtension();
        $file->move('uploads' . '/' . $dir, $image);
        return $image;
    }
}

