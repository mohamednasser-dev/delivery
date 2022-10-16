<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;

use App\Http\Requests\Restaurant\RegisterRequest;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $restaurant = Restaurant::create($data);
        return $this->sendResponse(__('lang.restaurant_created_wait_approve'), (object)[], 200);
    }


    public function verify_email(RegisterRequest $request)
    {
        $data = $request->validated();
        $validated_otp = \Otp::validate($data['email'], $data['otp']);
        if ($validated_otp->status == true) {
            unset($data['otp']);
            $created_user = Restaurant::create($data);
            if ($created_user) {
                $credentials = $request->only(['phone', 'password']);
                $token = Auth::guard('api')->attempt($credentials);
                if (!$token) {
                    return $this->errorLoginResponse(__('lang.login_data_not_correct'), null, failed());
                } else {
                    $logined_user = Auth::guard('api')->user();
                    $logined_user->token_api = $token;

                    return $this->sendResponse($logined_user, __('lang.login_s'), success());
                }
            }
        } else {
            return $this->errorLoginResponse(__('lang.otp_invalid'), null, failed());
        }
    }
}
