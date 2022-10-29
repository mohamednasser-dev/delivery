<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Requests\Restaurant\Option\OptionDestroyRequest;
use App\Http\Requests\Restaurant\Option\OptionRequest;
use App\Http\Resources\OptionResources;
use App\Models\Option;
use App\Http\Controllers\Controller;

class OptionsController extends Controller
{

    public function index()
    {
        $posts = Option::where('attribute_id', request()->attribute_id)->paginate(pagination_number());
        $data = (OptionResources::collection($posts))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function store(OptionRequest $request)
    {
        $data = $request->validated();
        $data['restaurant_id'] = restaurant()->id;
//        dd($data);
        Option::create($data);
        return $this->sendSuccess(__('lang.created_s'), 201);
    }

    public function update(OptionRequest $request)
    {
        $data = $request->validated();
        Option::where('id', $data['id'])->update($data);
        return $this->sendSuccess(__('lang.updated_s'), 201);
    }

    public function destroy(OptionDestroyRequest $request)
    {
        $data = $request->validated();
        Option::where('id', $data['id'])->delete();
        return $this->sendSuccess(__('lang.deleted_s'), 201);
    }


}
