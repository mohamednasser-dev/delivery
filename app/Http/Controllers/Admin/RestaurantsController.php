<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RestaurantRequest;
use App\Mail\RestaurantPasswordMail;
use App\Models\Nationality;
use App\Models\OwnerType;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Exception;
use Illuminate\Support\Facades\Mail;

class RestaurantsController extends Controller
{
    protected $viewPath = 'admin.restaurants.';
    private $route = 'restaurants';
    protected $paginate = 30;
    public $objectName;

    public function __construct(Restaurant $model)
    {
        $this->objectName = $model;
    }

    public function index()
    {
        $data = $this->objectName::orderBy('created_at', 'desc')->get();
        return view($this->viewPath . 'index', compact('data'));
    }

    public function create()
    {
        $restaurant_types = RestaurantType::get();
        $nationalities = Nationality::get();
        $owner_types = OwnerType::get();
        return view($this->viewPath . 'create', compact( 'restaurant_types', 'nationalities','owner_types'));
    }

    public function store(RestaurantRequest $request)
    {
        $data = $request->validated();
        $this->objectName::create($data);
        session()->flash('success', trans('lang.addedsuccess'));
        return redirect()->route($this->route . '.index');
    }


    public function edit($id)
    {
        $data = $this->objectName::findOrFail($id);
        return view($this->viewPath . 'edit', compact('data'));
    }


    public function update(RestaurantRequest $request, $id)
    {
        $data = $request->validated();
        $this->objectName::findOrFail($id)->update($data);
        session()->flash('success', trans('lang.updatSuccess'));
        return redirect()->back();
    }

    public function change_status($id, $status)
    {
        $restaurant = $this->objectName::findOrFail($id);

        $restaurant->update(['status' => $status]);
        if (!$restaurant->password && $status == Restaurant::STATUS_ACCEPTED) {
//            $password = rand(100000, 999999);
            $password = '123456';
            $restaurant->update(['password' => $password]);
            $mailData = [
                'title' => 'A New Password For Your Restaurant',
                'body' => 'Your Password is' . $password
            ];
            Mail::to($restaurant->email)->send(new RestaurantPasswordMail($mailData));

        }
        session()->flash('success', trans('lang.updatSuccess'));
        return redirect()->route($this->route . '.index');
    }


    public function destroy($id)
    {
        $hospital = $this->objectName::findORFail($id);
        try {
            $hospital->delete();
            session()->flash('success', trans('lang.deleteSuccess'));
        } catch (Exception $exception) {
            session()->flash('danger', trans('lang.emp_no_delete'));
        }
        return back();
    }
}
