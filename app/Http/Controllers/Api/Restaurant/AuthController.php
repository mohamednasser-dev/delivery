<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\LoginRequest;
use App\Http\Requests\Restaurant\RegisterRequest;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use App\Traits\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use JsonResponseTrait;

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $restaurant = Restaurant::create($data);

        return $this->sendResponse(__('lang.restaurant_created_wait_approve'), false, 200);
    }

    public function login(LoginRequest $request)
    {

        $data = $request->validated();
        $restaurant = Restaurant::where('email', $data['email'])->first();

        $token = $restaurant->createToken("TOKEN")->plainTextToken;

        $auth =  Auth::guard('restaurant')->attempt($data);
        if ($auth) {
            $response = [
                'restaurant' => new RestaurantResource($restaurant),
                'admin_token' => $token
            ];
            return response($response, 201);
        }

        return $this->respondWithFail('Wrong credentials');
    }

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();

        return $this->sendResponse('تم تسجيل الخروج بنجاح', false, 200);
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
