<?php

use App\Models\Setting;

if (!function_exists('restaurant')) {
    function restaurant()
    {
        return auth('sanctum')->user();
    }
}

if (!function_exists('pagination_number')) {
    function pagination_number()
    {
        return 6;
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

