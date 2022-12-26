<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\Customer\RestaurantResources;
use App\Http\Resources\Customer\SectionResources;
use App\Http\Resources\Customer\OfferResources;
use App\Http\Controllers\Controller;
use App\Models\RestaurantSection;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Offer;


class HomeController extends Controller
{

    public function index(Request $request)
    {
        $lang = app()->getLocale() ;
        $section_id = (array)$request->section_id;
        $offers = Offer::get();
        $sections = Section::select('id','name_'.$lang .' as title','image')->get()->makeHidden('name')->toArray();
        $restaurantsSections = isset($section_id) ? RestaurantSection::whereIn('section_id',$section_id)->pluck('restaurant_id') : RestaurantSection::pluck('restaurant_id');
       // add all section in sections ....
        $all = [
            'id' => 0,
            'title' => $lang  == 'ar' ? 'الكل' : 'All',
            'image' => "",
        ];
        array_unshift($sections, $all);
        $restaurants = Restaurant::whereIn('id',$restaurantsSections)->paginate(pagination_number());
        $response = [
            'offers' => isset($offers) ? OfferResources::collection($offers) : [],
            'sections' => isset($sections) ? $sections  : [],
            'restaurants' => isset($restaurants) ? RestaurantResources::collection($restaurants)->response()->getData(true) : [],
        ];
        return $this->sendSuccessData(__('lang.data_show_successfully'), $response);
    }

    public function searchRestaurants(Request $request)
    {
        $section_id = (array)$request->section_id;
        $sestaurantsSections = isset($section_id) ? RestaurantSection::whereIn('section_id',$section_id)->pluck('restaurant_id') : RestaurantSection::pluck('restaurant_id');

        if(isset($request->section_id) && $request->section_id == 0){
            //-->>>>>>>
            if(
                isset($request->search_key) &&
                (!empty($request->search_key) || ($request->search_key != null) )
            ){
                $restaurants = Restaurant::whereIn('id',$sestaurantsSections)
                    ->where(function ($q) use ($request){
                        $q->where('name_ar','like', '%' . $request->search_key . '%')
                            ->orWhere('name_en','like', '%' . $request->search_key . '%');
                    })->paginate(pagination_number());
            }else{
                $restaurants = Restaurant::whereIn('id',$sestaurantsSections)
                    ->paginate(pagination_number());
            }
            //-->>>>>>>
        }else{
            //--------->
            if(
                isset($request->search_key) &&
                (!empty($request->search_key) || ($request->search_key != null) )
            ){
                $restaurants = Restaurant::where(function ($q) use ($request){
                    $q->where('name_ar','like', '%' . $request->search_key . '%')
                        ->orWhere('name_en','like', '%' . $request->search_key . '%');
                })->paginate(pagination_number());
            }else{
                $restaurants = Restaurant::paginate(pagination_number());
            }
            //--------->
        }

        $response = isset($restaurants) ? RestaurantResources::collection($restaurants)->response()->getData(true) : [];
        return $this->sendSuccessData(__('lang.data_show_successfully'), $response);
    }

    public function searchSections(Request $request)
    {
        if(
            isset($request->search_key) &&
            (!empty($request->search_key) || ($request->search_key != null) )
        ){
            $sections = Section::where(function ($q) use ($request){
                $q->where('name_ar','like', '%' . $request->search_key . '%')
                    ->orWhere('name_en','like', '%' . $request->search_key . '%');
            })->paginate(pagination_number());
        }else{
            $sections = Section::paginate(pagination_number());
        }

        $response = isset($sections) ?  SectionResources::collection($sections)->response()->getData(true) : [];

        return $this->sendSuccessData(__('lang.data_show_successfully'), $response);
    }

}
