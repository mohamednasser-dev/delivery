<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Requests\Customer\FavoriteRequest;
use App\Http\Requests\Customer\RestaurantReviewIndexRequest;
use App\Http\Requests\Customer\RestaurantReviewRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\RestaurantDetailsMenuMealsResources;
use App\Http\Resources\Customer\RestaurantResources;
use App\Http\Resources\Customer\ReviewsResources;
use App\Models\Restaurant;
use App\Models\RestaurantReview;


class RestaurantReviewsController extends Controller
{

    public function index(RestaurantReviewIndexRequest $request)
    {
        $data = $request->validated();
        $id = $data['restaurant_id'];

        $data = Restaurant::accepted()->active()->findOrFail($id);
        $result['restaurant_data'] =  new RestaurantResources($data);

        $rates_one = RestaurantReview::accepted()->where('restaurant_id', $id)->where('rate', 1)->get()->count();
        $rates_tow = RestaurantReview::accepted()->where('restaurant_id', $id)->where('rate', 2)->get()->count();
        $rates_three = RestaurantReview::accepted()->where('restaurant_id', $id)->where('rate', 3)->get()->count();
        $rates_four = RestaurantReview::accepted()->where('restaurant_id', $id)->where('rate', 4)->get()->count();
        $rates_five = RestaurantReview::accepted()->where('restaurant_id', $id)->where('rate', 5)->get()->count();
        $result['stars_count']['five'] = $rates_five;
        $result['stars_count']['four'] = $rates_four;
        $result['stars_count']['three'] = $rates_three;
        $result['stars_count']['tow'] = $rates_tow;
        $result['stars_count']['one'] = $rates_one;
        $reviews = RestaurantReview::accepted()->where('restaurant_id', $id)->orderBy('created_at', 'desc')->paginate(20);
        $result['reviews'] = ReviewsResources::collection($reviews)->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $result, 200);
    }

    public function store(RestaurantReviewRequest $request)
    {
        $data = $request->validated();
        $customer_id = auth('sanctum')->user()->id;
        //check if customer make favorite to same thing before
        $exist_fav = RestaurantReview::where('customer_id', $customer_id)->where('restaurant_id', $data['restaurant_id'])
            ->first();
        if ($exist_fav) {
//                    return $this->sendError(trans('lang.fav_exists_before'), 400);
            return $this->sendError(__('lang.review_exists_before'), 400);
        }
        //end check
        //generate data to save
        $data['customer_id'] = $customer_id;
        RestaurantReview::create($data);
        return $this->sendSuccess(__('lang.review_added'), 201);
    }
}
