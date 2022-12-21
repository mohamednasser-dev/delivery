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
        $section_id = (array)$request->section_id;
        $offers = Offer::get();
//        $sections = array_merge(Section::get()->toArray(),[
//            'id'=>(int) 0,
//            'name'=> request()->header('lang') == 'ar' ? 'الكل' : 'All',
//            'image'=> '',
//        ]);
        $sections = Section::get();
        $sestaurantsSections = isset($section_id) ? RestaurantSection::whereIn('section_id',$section_id)->pluck('restaurant_id') : RestaurantSection::pluck('restaurant_id');
        $restaurants = Restaurant::whereIn('id',$sestaurantsSections)->paginate(pagination_number());
        $response = [
            'offers' => isset($offers) ? OfferResources::collection($offers) : [],
            'sections' => isset($sections) ?  SectionResources::collection(collect($sections)) : [],
            'restaurants' => isset($restaurants) ? RestaurantResources::collection($restaurants)->response()->getData(true) : [],
        ];
        return $this->sendSuccessData(__('lang.data_show_successfully'), $response);
    }

    public function searchRestaurants(Request $request)
    {
        $section_id = (array)$request->section_id;
        $sections = Section::get();
        $sestaurantsSections = isset($section_id) ? RestaurantSection::whereIn('section_id',$section_id)->pluck('restaurant_id') : RestaurantSection::pluck('restaurant_id');
        $restaurants = Restaurant::whereIn('id',$sestaurantsSections)->paginate(pagination_number());
        $response = [
            'offers' => isset($offers) ? OfferResources::collection($offers) : [],
            'sections' => isset($sections) ?  SectionResources::collection($sections) : [],
            'restaurants' => isset($restaurants) ? RestaurantResources::collection($restaurants)->response()->getData(true) : [],
        ];
        return $this->sendSuccessData(__('lang.data_show_successfully'), $response);
    }

    public function searchSections(Request $request)
    {
        $section_id = (array)$request->section_id;
        $sections = Section::get();
        $sestaurantsSections = isset($section_id) ? RestaurantSection::whereIn('section_id',$section_id)->pluck('restaurant_id') : RestaurantSection::pluck('restaurant_id');
        $restaurants = Restaurant::whereIn('id',$sestaurantsSections)->paginate(pagination_number());
        $response = [
            'offers' => isset($offers) ? OfferResources::collection($offers) : [],
            'sections' => isset($sections) ?  SectionResources::collection($sections) : [],
            'restaurants' => isset($restaurants) ? RestaurantResources::collection($restaurants)->response()->getData(true) : [],
        ];
        return $this->sendSuccessData(__('lang.data_show_successfully'), $response);
    }

}
