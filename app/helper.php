<?php


if (!function_exists('restaurant')) {
    function restaurant()
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

