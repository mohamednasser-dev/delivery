<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\NationalityResources;
use App\Http\Resources\OwnerTypeResources;
use App\Http\Resources\RestaurantTypeResources;
use App\Http\Resources\SectionResources;
use App\Http\Resources\SettingResources;
use App\Models\Nationality;
use App\Models\OwnerType;
use App\Models\RestaurantType;
use App\Models\Section;
use App\Models\Setting;
use App\Models\User;

class HelpersController extends Controller
{

    public function owner_types()
    {
        $data = OwnerType::orderBy('created_at', 'desc')->get();
        $data = (OwnerTypeResources::collection($data));
        return $this->sendSuccessData(__('lang.data_shown_s'), $data);
    }

    public function restaurant_types()
    {
        $data = RestaurantType::orderBy('id', 'asc')->get();
        $data = (RestaurantTypeResources::collection($data));
        return $this->sendSuccessData(__('lang.data_shown_s'), $data);
    }
    public function nationalities()
    {
        $data = Nationality::orderBy('id', 'asc')->get();
        $data = (NationalityResources::collection($data));
        return $this->sendSuccessData(__('lang.data_shown_s'), $data);
    }
    public function settings()
    {
        $data = Setting::orderBy('id', 'asc')->get();
        $data = (SettingResources::collection($data));
        return $this->sendSuccessData(__('lang.data_shown_s'), $data);
    }
    public function sections()
    {
        $data = Section::orderBy('id', 'asc')->get();
        $data = (SectionResources::collection($data));
        return $this->sendSuccessData(__('lang.data_shown_s'), $data);
    }

}
