<?php

namespace App\Http\Controllers\Api\Customer;


use App\Http\Requests\Customer\ProfileRequest;
use App\Http\Resources\Customer\CustomerResources;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{

    public function profile(Request $request)
    {
        $customer_Data = auth('sanctum')->user();
        $customer_Data = new CustomerResources($customer_Data);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $customer_Data);
    }

    public function update_profile(ProfileRequest $request)
    {
        $data = $request->validated();
        Customer::whereId(customer()->id)->update($data);


//        $data = $request->all();
//        $validator = Validator::make($data, [
//            'name' => 'required|string|max:255',
//            'phone' => 'required|string|max:20|unique:users,phone,' . auth('sanctum')->user()->id,
//            'city_id' => 'required|exists:cities,id',
//        ]);
//        if ($validator->fails()) {
//            return $this->sendError($validator->messages()->first());
//
//        }
//        $id = auth('sanctum')->user()->id;
//        Customer::findOrFail($id)->update($data);
        $user = Customer::whereId(customer()->id)->first();
        $user = (new CustomerResources($user));
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
        $user = Customer::findOrFail(auth('sanctum')->user()->id);
        if (\Hash::check($request->old_password, $user->password)) {
            $user->password = $request->password;
            $user->save();
            return $this->sendSuccess(__('lang.user_password_updated_successfully'));
        } else {
            return $this->sendError(trans('lang.current_pass_incorrect'));
        }
    }

}
