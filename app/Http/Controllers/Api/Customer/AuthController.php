<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Requests\Customer\Forget_password\ChangePasswordRequest;
use App\Http\Requests\Customer\Forget_password\ForgetPasswordRequest;
use App\Http\Requests\Customer\Forget_password\VerifyOtpRequest;
use App\Http\Requests\Customer\SendEmailCheckCodeRequest;
use App\Http\Requests\Customer\SendPhoneCheckCodeRequest;
use App\Http\Requests\Customer\EmailCheckCodeRequest;
use App\Http\Requests\Customer\PhoneCheckCodeRequest;
use App\Http\Resources\Customer\CustomerResources;
use App\Http\Resources\RestaurantTypeResources;
use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Requests\Customer\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResources;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPasswordMail;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        Customer::create($data);
        return $this->sendSuccess(__('lang.customer_created_success'), 201);
    }

    public function login(LoginRequest $request)
    {

        $data = $request->validated();
        $auth = Auth::guard('customer')->attempt($data);
        if ($auth) {
            $restaurant = Auth::guard('customer')->user();
            $token = $restaurant->createToken("TOKEN")->plainTextToken;
            $response = [
                'customer' => new CustomerResources($restaurant),
                'access_token' => $token,
                'refresh_token' => Hash::make(env('APP_KEY')),
            ];
            return $this->sendSuccessData(__('lang.login_s'), $response, 201);
        }
        return $this->sendError(__('lang.wrong_password'));
    }

    public function logout()
    {
        auth('customer')->user()->tokens()->delete();
        return $this->sendSuccess(__('lang.logout_s'));
    }

    public function send_email_check_code(SendEmailCheckCodeRequest $request)
    {
        $data = $request->validated();
        //check first is email exists before or not
        $exists_email = Customer::where('email', $data['email'])->first();
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
        $exists_email = Customer::where('phone', $data['phone'])->first();
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
            $restaurant = Customer::where('email', $data['email'])->first();
            if ($restaurant) {
                if ($restaurant->status == 'new') {
                    return $this->sendError(__('lang.wait_admin_to_accept'));
                } elseif ($restaurant->status == 'rejected') {
                    return $this->sendError(__('lang.you_a_rejected'));
                }
                $token = $restaurant->createToken("TOKEN")->plainTextToken;
                $response = [
                    'restaurant' => new CustomerResources($restaurant),
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
        Customer::findOrFail($id)->update($data);
        $user = Customer::findOrFail($id);
        $user = (new RestaurantTypeResources($user));

        return $this->sendSuccess(__('lang.password_updated_s'));

    }

    public function refreshToken()
    {
        $hashedAppKey = Hash::make(env('APP_KEY'));
        if(Hash::check(env('APP_KEY'),request()->refresh_token)){
            $restaurant_data = restaurant();
            if(!$restaurant_data)
                return $this->sendError(__('lang.error'));

            $restaurant_id = restaurant()->id;
            $restaurant = Customer::whereId($restaurant_id)->first();
            if(!$restaurant)
                return $this->sendError(__('lang.error'));

            auth('sanctum')->user()->tokens()->delete();
            $token = $restaurant->createToken("TOKEN")->plainTextToken;
            $response = [
                'customer' => new CustomerResources($restaurant),
                'access_token' => $token,
                'refresh_token' => $hashedAppKey,
            ];
            return $this->sendSuccessData(__('lang.login_s'), $response, 201);
        }
        return $this->sendError(__('lang.codeError'));
    }

    public function socialLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'social_type' => 'required|in:facebook,google,apple,twitter,instagram,snapchat',
            'social_id' => 'required',
            'email' => 'nullable',
        ]);
        if (!is_array($validator) && $validator->fails()) {
            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);
        }
        // 1- check phone exists
//        $user = User::where('email', $request->email)->first();
//        if ($user) {
//            if ($request->social_type == 'facebook') {
//                $user->social_id = $request->social_id;
//            } else {
//                $user->social_id = $request->social_id;
//            }
//            if (empty($user->email_verified_at)) {
//                $user->email_verified_at = Carbon::now();
//            }
//            $user->email = $request->email;
//            $user->fcm_token = $request->device_token;
//            $user->save();
//            $jwt_token = JWTAuth::fromUser($user);
//            $data = (new UsersResources($user))->token($jwt_token);
//            return response()->json(msgdata($request, success(), trans('lang.success'), $data));
//        }

        // 2- check social id exists
        $hashedAppKey = Hash::make(env('APP_KEY'));

        $userFound = Customer::where('social_id', $request->social_id)
            ->where('social_type', $request->social_type)
            ->first();
        if ($userFound) {
//            $userFound->email = $request->email;
            $token = $userFound->createToken("TOKEN")->plainTextToken;
            $response = [
                'customer' => new CustomerResources($userFound),
                'access_token' => $token,
                'refresh_token' => $hashedAppKey,
            ];
            return $this->sendSuccessData(__('lang.login_s'), $response, 201);
        }

        // 3- if not login with social before
        try {

            $user = Customer::create([
                'social_id' => $request->social_id,
                'fcm_token' => $request->device_token,
                'email' => $request->email,
                'email_verified_at' => Carbon::now(),
                'active' => 1,
                'social_type' => $request->social_type
            ]);

            $token = $userFound->createToken("TOKEN")->plainTextToken;
            $response = [
                'customer' => new CustomerResources($userFound),
                'access_token' => $token,
                'refresh_token' => $hashedAppKey,
            ];
            return $this->sendSuccessData(__('lang.login_s'), $response, 201);

        }catch (\Exception $e){
            return $this->sendError(__('lang.error'));
        }

//        $jwt_token = JWTAuth::fromUser($user);
//        $data = (new UsersResources($user))->token($jwt_token);
//        return response()->json(msgdata($request, success(), trans('lang.success'), $data));
    }
}
