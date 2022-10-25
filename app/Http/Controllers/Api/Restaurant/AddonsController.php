<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Requests\Restaurant\Addon\AddonDestroyRequest;
use App\Http\Requests\Restaurant\Addon\AddonRequest;
use App\Http\Resources\AddonResources;
use App\Models\Addon;
use App\Http\Controllers\Controller;

class AddonsController extends Controller
{

    public function index()
    {
        $posts = Addon::where('restaurant_id', restaurant()->id)->paginate(pagination_number());
        $data = (AddonResources::collection($posts))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function store(AddonRequest $request)
    {
        $data = $request->validated();
        $data['restaurant_id'] = restaurant()->id;
        Addon::create($data);
        return $this->sendSuccess(__('lang.created_s'), 201);
    }

    public function update(AddonRequest $request)
    {
        $data = $request->validated();
        Addon::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->update($data);
        return $this->sendSuccess(__('lang.updated_s'), 201);
    }

    public function destroy(AddonDestroyRequest $request)
    {
        $data = $request->validated();
        Addon::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->delete();
        return $this->sendSuccess(__('lang.deleted_s'), 201);
    }


}
