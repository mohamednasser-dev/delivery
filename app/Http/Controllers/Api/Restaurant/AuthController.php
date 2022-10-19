<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\EmailCheckCodeRequest;
use App\Http\Requests\Restaurant\LoginRequest;
use App\Http\Requests\Restaurant\RegisterRequest;
use App\Http\Requests\Restaurant\SendEmailCheckCodeRequest;
use App\Http\Resources\RestaurantResource;
use App\Mail\CodeMail;
use App\Models\Phone_check;
use App\Models\Restaurant;
use App\Traits\JsonResponseTrait;
use Ghanem\LaravelSmsmisr\Facades\Smsmisr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


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

        $auth = Auth::guard('restaurant')->attempt($data);
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

    public function send_email_check_code(SendEmailCheckCodeRequest $request)
    {
        $data = $request->validated();
        //generate random 4 numbers
        $otp = \Otp::generate($data['email']);
        $details = [
            'title' => 'Verification',
            'body' => 'Thank you for registering on LimaZola app;your code is :' . $otp,
        ];
        try {
            //Mail::to($data['email'])->send(new CodeMail($details));

        } catch (\Exception $e) {
            return $this->sendError(trans('lang.send_valid_email'), null, 401);
        }
        $result['otp'] = $otp;
        return $this->sendResponse(trans('lang.verify_email'), $result, 200);

    }

    public function verify_email(EmailCheckCodeRequest $request)
    {
        $data = $request->validated();
        $validated_otp = \Otp::validate($data['email'], $data['otp']);
        if ($validated_otp->status == true) {
            return $this->sendResponse(__('lang.code_checked_s'));
        } else {
            return $this->sendError(__('lang.otp_invalid'));
        }
    }
}
