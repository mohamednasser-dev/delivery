<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Requests\Restaurant\Attribute\AttributeDestroyRequest;
use App\Http\Requests\Restaurant\Attribute\AttributeRequest;
use App\Http\Resources\AttributeResources;
use App\Http\Controllers\Controller;
use App\Models\Attribute;

class AttributesController extends Controller
{

    public function index()
    {
        $posts = Attribute::where('restaurant_id', restaurant()->id)->paginate(pagination_number());
        $data = (AttributeResources::collection($posts))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function store(AttributeRequest $request)
    {
        $data = $request->validated();
        $data['restaurant_id'] = restaurant()->id;
        Attribute::create($data);
        return $this->sendSuccess(__('lang.created_s'), 201);
    }

    public function update(AttributeRequest $request)
    {
        $data = $request->validated();
        Attribute::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->update($data);
        return $this->sendSuccess(__('lang.updated_s'), 201);
    }

    public function destroy(AttributeDestroyRequest $request)
    {
        $data = $request->validated();
        Attribute::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->delete();
        return $this->sendSuccess(__('lang.deleted_s'), 201);
    }


}
