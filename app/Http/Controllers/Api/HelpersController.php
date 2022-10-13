<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\OwnerTypeResources;
use App\Http\Resources\RestaurantTypeResources;
use App\Models\Nationality;
use App\Models\OwnerType;
use App\Models\RestaurantType;
use App\Models\User;

class HelpersController extends Controller
{

    public function owner_types()
    {
        $data = OwnerType::orderBy('created_at', 'desc')->get();
        $data = (OwnerTypeResources::collection($data));
        return $this->sendResponse(__('lang.data_shown_s'), $data);
    }

    public function restaurant_types()
    {
        $data = RestaurantType::orderBy('id', 'asc')->get();
        $data = (RestaurantTypeResources::collection($data));
        return $this->sendResponse(__('lang.data_shown_s'), $data);
    }
    public function nationalities()
    {
        $data = Nationality::orderBy('id', 'asc')->get();
        $data = (RestaurantTypeResources::collection($data));
        return $this->sendResponse(__('lang.data_shown_s'), $data);
    }


}
