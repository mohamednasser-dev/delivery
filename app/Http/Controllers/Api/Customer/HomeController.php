<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\Customer\HomeResources;
use App\Http\Resources\Customer\OfferResources;
use App\Http\Resources\Customer\SectionResources;
use App\Http\Resources\Customer\RestaurantResources;
use App\Models\Offer;
use App\Models\Restaurant;
use App\Models\RestaurantSection;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{

    public function index(Request $request)
    {
        $offers = Offer::get();
        $sections = Section::get();
        $sestaurantsSections = RestaurantSection::pluck('restaurant_id');
        $restaurants = Restaurant::whereIn('id',$sestaurantsSections)->get();
        $response = [
            'offers' => isset($offers) ? OfferResources::collection($offers) : [],
            'sections' => isset($sections) ?  SectionResources::collection($sections) : [],
            'restaurants' => isset($restaurants) ? RestaurantResources::collection($restaurants) : [],
        ];
        return $this->sendSuccessData(__('lang.data_show_successfully'), $response);
    }

}
