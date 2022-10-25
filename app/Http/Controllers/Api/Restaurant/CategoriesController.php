<?php

namespace App\Http\Controllers\Api\Restaurant;


use App\Http\Requests\Restaurant\categoryDestroyRequest;
use App\Http\Requests\Restaurant\categoryRequest;
use App\Http\Resources\CategoryResources;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    public function index()
    {
        $posts = Category::where('restaurant_id', restaurant()->id)->paginate(pagination_number());
        $data = (CategoryResources::collection($posts))->response()->getData(true);
        return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
    }

    public function store(categoryRequest $request)
    {

        $data = $request->validated();
        $data['restaurant_id'] = restaurant()->id;
        Category::create($data);
        return $this->sendSuccess(__('lang.created_s'), 201);
    }

    public function update(categoryRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'pending';
        Category::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->update($data);
        return $this->sendSuccess(__('lang.updated_s'), 201);
    }

    public function destroy(categoryDestroyRequest $request)
    {
        $data = $request->validated();
        Category::where('id', $data['id'])->where('restaurant_id', restaurant()->id)->delete();
        return $this->sendSuccess(__('lang.deleted_s'), 201);
    }


}
