<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Requests\Customer\FavoriteRequest;
use App\Http\Requests\Customer\RestaurantReviewRequest;
use App\Http\Resources\FavoriteResources;
use App\Http\Controllers\Controller;
use App\Models\RestaurantReview;
use Illuminate\Http\Request;
use App\Models\Favorite;


class RestaurantReviewsController extends Controller
{

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
