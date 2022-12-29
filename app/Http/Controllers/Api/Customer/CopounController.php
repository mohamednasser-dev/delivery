<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CopounResources;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Coupon;


class CopounController extends Controller
{

    public function checkCopoun(Request $request)
    {
        $copon = Coupon::where('code', $request->code)
            ->first();
        if ($copon) {
            if (
                ($copon->from_date < Carbon::now()->format('Y-m-d')) &&
                ($copon->to_date > Carbon::now()->format('Y-m-d'))
            ) {
                $data =  new CopounResources($copon);
                return $this->sendSuccessData(__('lang.data_show_successfully'), $data);
            }
        }
        return $this->sendError(__('lang.invalid_copoun'));
    }
}
