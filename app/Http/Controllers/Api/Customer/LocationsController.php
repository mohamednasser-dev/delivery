<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\Customer\CustomerLocationsResources;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\CustomerAdress;
use Illuminate\Http\Request;
use App\Models\Customer;


class LocationsController extends Controller
{

    public function index(Request $request)
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

    public function create(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'lat' => 'required|string',
            'lng' => 'required|string',
            'address' => 'required|min:3|max:2999',
            'title' => 'required|min:3|max:15',
            'main' => 'required|in:0,1',
            'phone' => 'required',
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
                'phone' => $request->phone,
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

    public function update(Request $request)
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
