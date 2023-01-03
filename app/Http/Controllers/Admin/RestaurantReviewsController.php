<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RestaurantTypeRequest;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\RestaurantReview;
use App\Models\RestaurantType;
use App\Models\Retailer;
use App\Models\RetailerRate;
use Exception;

class RestaurantReviewsController extends Controller
{
    protected $viewPath = 'admin.reviews.';
    private $route = 'reviews';
    protected $paginate = 30;
    public $objectName;

    public function __construct(RestaurantReview $model)
    {
        $this->objectName = $model;
    }

    public function index()
    {
        $data = $this->objectName::orderBy('created_at', 'desc')->get();
        return view($this->viewPath . 'index', compact('data'));
    }

    public function change_status($status, $id)
    {
        $review = $this->objectName::findOrFail($id);
        $review->status = $status;
        $review->save();
        //update target rate
        $restaurant = Restaurant::findOrFail($review->restaurant_id);
        $count_rates = $restaurant->reviews->count();
        if ($count_rates == 0) {
            $rate = 0;
        } else {
            $sum_rates = $restaurant->reviews->sum('rate');
            $rate = $sum_rates / $count_rates;
        }
        $restaurant->rating = $rate;
        $restaurant->save();
        //end update
        return redirect()->back()->with('success', 'تم تغيير الحالة بنجاح');
    }

}
