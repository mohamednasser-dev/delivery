<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Requests\Restaurant\Forget_password\ChangePasswordRequest;
use App\Http\Requests\Restaurant\Forget_password\ForgetPasswordRequest;
use App\Http\Requests\Restaurant\Forget_password\VerifyOtpRequest;
use App\Http\Requests\Restaurant\SendEmailCheckCodeRequest;
use App\Http\Requests\Restaurant\SendPhoneCheckCodeRequest;
use App\Http\Requests\Restaurant\EmailCheckCodeRequest;
use App\Http\Requests\Restaurant\PhoneCheckCodeRequest;
use App\Http\Requests\Restaurant\RegisterRequest;
use App\Http\Resources\RestaurantTypeResources;
use App\Http\Requests\Restaurant\LoginRequest;
use App\Http\Resources\RestaurantResources;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantSection;
use App\Mail\ForgetPasswordMail;
use App\Models\Restaurant;
use Teckwei1993\Otp\Otp;


class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $restaurant = Restaurant::create($data);
        if (count($data['sections']) > 0) {
            foreach ($data['sections'] as $section) {
                $section_data['restaurant_id'] = $restaurant->id;
                $section_data['section_id'] = $section;
                RestaurantSection::create($section_data);
            }
        }
        return $this->sendSuccess(__('lang.restaurant_created_wait_approve'), 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $auth = Auth::guard('restaurant')->attempt($data);
        if ($auth) {
            $restaurant = Auth::guard('restaurant')->user();
            if ($restaurant->status == 'new') {
                return $this->sendError(__('lang.wait_admin_to_accept'));
            } elseif ($restaurant->status == 'rejected') {
                return $this->sendError(__('lang.you_a_rejected'));
            }
            $token = $restaurant->createToken("TOKEN")->plainTextToken;
            $response = [
                'restaurant' => new RestaurantResources($restaurant),
                'access_token' => $token,
                'refresh_token' => Hash::make(env('APP_KEY')),
            ];
            return $this->sendSuccessData(__('lang.login_s'), $response, 201);
        }
        return $this->sendError(__('lang.wrong_password'));
    }

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();
        return $this->sendSuccess(__('lang.logout_s'));
    }

    public function send_email_check_code(SendEmailCheckCodeRequest $request)
    {
        $data = $request->validated();
        //check first is email exists before or not
        $exists_email = Restaurant::where('email', $data['email'])->first();
        if ($exists_email) {
            return $this->sendError(trans('lang.email_exists_before'), 406);
        }
        //generate random 4 numbers
        $otp = \Otp::generate($data['email']);
        $details = [
            'title' => 'Verification',
            'body' => 'Thank you for registering on LimaZola app;your code is :' . $otp,
        ];
        try {
            //Mail::to($data['email'])->send(new CodeMail($details));
        } catch (\Exception $e) {
            return $this->sendError(__('lang.send_valid_email'), 401);
        }
        $result['otp'] = $otp;
        return $this->sendSuccessData(trans('lang.verify_email'), $result, 200);
    }

    public function verify_email(EmailCheckCodeRequest $request)
    {
        $data = $request->validated();
        $validated_otp = \Otp::validate($data['email'], $data['otp']);
        if ($validated_otp->status == true) {
            return $this->sendSuccess(__('lang.code_checked_s'));
        } else {
            return $this->sendError(__('lang.otp_invalid'));
        }
    }

    //phone check
    public function send_phone_check_code(SendPhoneCheckCodeRequest $request)
    {
        $data = $request->validated();
        //check first is phone exists before or not
        $exists_email = Restaurant::where('phone', $data['phone'])->first();
        if ($exists_email) {
            return $this->sendError(__('lang.phone_exists_before'), 406);
        }
        //generate random 4 numbers
        $otp = \Otp::generate($data['phone']);
        $details = [
            'title' => 'Verification',
            'body' => 'Thank you for registering on LimaZola app;your code is :' . $otp,
        ];
        try {
            //sms Gateway here ...
        } catch (\Exception $e) {
            return $this->sendError(__('lang.send_valid_phone'), 401);
        }
        $result['otp'] = $otp;
        return $this->sendSuccessData(trans('lang.verify_email'), $result, 200);
    }

    public function verify_phone(PhoneCheckCodeRequest $request)
    {
        $data = $request->validated();
        $validated_otp = \Otp::validate($data['phone'], $data['otp']);
        if ($validated_otp->status == true) {
            return $this->sendSuccess(__('lang.code_checked_s'));
        } else {
            return $this->sendError(__('lang.otp_invalid'));
        }
    }

//forget_password
    public function forget_password(ForgetPasswordRequest $request)
    {
        $data = $request->validated();
        $otp = \Otp::generate($data['email']);
        $mailData = [
            'title' => 'Code for rest you account password ',
            'body' => 'Your code is' . $otp
        ];
        Mail::to($data['email'])->send(new ForgetPasswordMail($mailData));
        $data['otp'] = $otp;
        return $this->sendSuccessData(__('lang.code_sent_s'), $otp, 200);
    }

    public function forget_password_verify_code(VerifyOtpRequest $request)
    {
        $data = $request->validated();
        $validated_otp = \Otp::validate($data['email'], $data['otp']);
        if ($validated_otp->status == true) {
            unset($data['otp']);
            $restaurant = Restaurant::where('email', $data['email'])->first();
            if ($restaurant) {
                if ($restaurant->status == 'new') {
                    return $this->sendError(__('lang.wait_admin_to_accept'));
                } elseif ($restaurant->status == 'rejected') {
                    return $this->sendError(__('lang.you_a_rejected'));
                }
                $token = $restaurant->createToken("TOKEN")->plainTextToken;
                $response = [
                    'restaurant' => new RestaurantResources($restaurant),
                    'access_token' => $token
                ];
                return $this->sendSuccessData(__('lang.Verified_success'), $response, 201);
            }
        } else {
            return $this->sendError(__('lang.codeError'));
        }
    }

    public function forget_password_change_password(ChangePasswordRequest $request)
    {
        $data = $request->validated();

        $id = auth('sanctum')->user()->id;
        Restaurant::findOrFail($id)->update($data);
        $user = Restaurant::findOrFail($id);
        $user = (new RestaurantTypeResources($user));

        return $this->sendSuccess(__('lang.password_updated_s'));

    }

    public function refreshToken()
    {
        $hashedAppKey = Hash::make(env('APP_KEY'));
        if(Hash::check(env('APP_KEY'),request()->refresh_token)){
            $restaurant_data = restaurant();
            if (!$restaurant_data)
                return $this->sendError(__('lang.error'));

            $restaurant_id = restaurant()->id;
            $restaurant = Restaurant::whereId($restaurant_id)->first();
            if (!$restaurant)
                return $this->sendError(__('lang.error'));

            auth('sanctum')->user()->tokens()->delete();
            $token = $restaurant->createToken("TOKEN")->plainTextToken;
            $response = [
                'restaurant' => new RestaurantResources($restaurant),
                'access_token' => $token,
                'refresh_token' => $hashedAppKey,

            ];
            return $this->sendSuccessData(__('lang.login_s'), $response, 201);
        }
        return $this->sendError(__('lang.codeError'));
    }
}
