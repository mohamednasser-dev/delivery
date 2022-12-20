<?php

namespace App\Http\Controllers\Api\Customer;


use App\Http\Requests\Customer\ProfileRequest;
use App\Http\Resources\Customer\CustomerLocationsResources;
use App\Http\Resources\Customer\CustomerResources;
use App\Models\Customer;
use App\Models\CustomerAdress;
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

    public function getMyLocations(Request $request)
    {
        $user = Customer::findOrFail(auth('sanctum')->user()->id);
        if ($user) {
            $posts = CustomerAdress::where('customer_id', $user->id)->paginate(pagination_number());
            $data = (CustomerLocationsResources::collection($posts))->response()->getData(true);
            return $this->sendSuccessData(__('lang.data_show_successfully'), $data);

        } else {
            return $this->sendError(trans('lang.error'));
        }
    }

    public function createLocation(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'lat' => 'required|string',
            'lng' => 'required|string',
            'address' => 'required|min:3|max:2999',
            'title' => 'required|min:3|max:15',
            'main' => 'required|in:0,1',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->messages()->first());
        }
        $user = Customer::findOrFail(auth('sanctum')->user()->id);
        if ($user) {
            $thisAddress = CustomerAdress::create([
                'lat' => $request->lat,
                'lng' => $request->lng,
                'address' => $request->address,
                'title' => $request->title,
                'main' => $request->main,
                'customer_id' => $user->id,
            ]);
            if($request->main == 1){
                Customer::whereId($user->id)->update([
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'address' => $request->address,
                ]);
                CustomerAdress::where('customer_id',$user->id)
                    ->where('id','!=',$thisAddress->id)
                    ->update([
                        'main' => 0,
                    ]);
            }
            return $this->sendSuccess(__('lang.created_s'), 201);
        } else {
            return $this->sendError(trans('lang.error'));
        }
    }

    public function updateLocation(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'location_id' => 'required|exists:customer_adresses,id',
            'lat' => 'sometimes|string',
            'lng' => 'sometimes|string',
            'address' => 'sometimes|min:3|max:2999',
            'title' => 'sometimes|min:3|max:15',
            'main' => 'sometimes|in:0,1',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->messages()->first());
        }
        $user = Customer::findOrFail(auth('sanctum')->user()->id);
        if ($user) {
            $thisAddress = CustomerAdress::whereId($request->location_id)
                ->where('customer_id',$user->id)->first();

            $thisAddress->update([
                    'lat' => isset($request->lat) ? $request->lat : $thisAddress->lat ,
                    'lng' => isset($request->lng) ? $request->lng : $thisAddress->lng ,
                    'address' => isset($request->address) ? $request->address : $thisAddress->address ,
                    'title' => isset($request->title) ? $request->title : $thisAddress->title ,
                    'main' => isset($request->main) ? $request->main : $thisAddress->main ,
                ]);
            if($request->main == 1){
                Customer::whereId($user->id)->update([
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'address' => $request->address,
                ]);
                CustomerAdress::where('customer_id',$user->id)
                    ->where('id','!=',$request->location_id)
                    ->update([
                        'main' => 0,
                    ]);
            }
            return $this->sendSuccess(__('lang.updated_s'), 201);
        } else {
            return $this->sendError(trans('lang.error'));
        }
    }

}
