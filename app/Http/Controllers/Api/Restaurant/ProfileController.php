<?php

namespace App\Http\Controllers\Api\Restaurant;


use App\Http\Resources\RestaurantResources;
use App\Http\Resources\RestaurantTypeResources;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{

    public function profile(Request $request)
    {
        $restaurant_Data = auth('sanctum')->user();
        $restaurant_Data = new RestaurantResources($restaurant_Data);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $restaurant_Data);
    }

    public function update_profile(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|max:20|unique:users,phone,' . auth('sanctum')->user()->id,
            'city_id' => 'required|exists:cities,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->messages()->first());

        }
        $id = auth('sanctum')->user()->id;
        Restaurant::findOrFail($id)->update($data);
        $user = Restaurant::findOrFail($id);
        $user = (new RestaurantTypeResources($user));
        return $this->sendSuccessData( __('lang.user_profile_updated_successfully'),$user);
    }


    public function update_password(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->messages()->first());
        }
        $user = Restaurant::findOrFail(auth('sanctum')->user()->id);
        if (\Hash::check($request->old_password, $user->password)) {
            $user->password = $request->password;
            $user->save();
            return $this->sendSuccess(__('lang.user_password_updated_successfully'));
        } else {
            return $this->sendError(trans('lang.current_pass_incorrect'));
        }
    }

}
