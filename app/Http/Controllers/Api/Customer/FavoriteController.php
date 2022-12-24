<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Requests\Customer\FavoriteRequest;
use App\Http\Resources\FavoriteResources;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;


class FavoriteController extends Controller
{

    public function index(Request $request)
    {
        $get = Favorite::get();
        $data = FavoriteResources::collection($get)->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function store(FavoriteRequest $request)
    {
        $data = $request->validated();
        $customer_id = auth('sanctum')->user()->id;

            //check if customer make favorite to same thing before
                $exist_fav = Favorite::where('customer_id',$customer_id)->where('restaurant_id', $data['restaurant_id'])
                    ->first();
                if ($exist_fav) {
                    $exist_fav->delete();
//                    return $this->sendError(trans('lang.fav_exists_before'), 400);
                    return $this->sendSuccess(__('lang.fav_exists_before'), 201);

                }
            //end check
        //generate data to save
        $data['customer_id'] = $customer_id;
        Favorite::create($data);
        return $this->sendSuccess(__('lang.favorite_added'), 201);
    }
}
