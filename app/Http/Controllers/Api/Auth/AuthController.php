<?php

namespace App\Http\Controllers\Api\Auth;

use App\Core\Helpers\Utilities;
use App\Http\Controllers\Controller;
 use App\Models\ResetPassword;

use App\Models\User;
use App\Models\UserToken;
use App\Traits\GeneralFunction;
use Carbon\Carbon;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    use GeneralFunction;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));
    }

    public function register(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string',
                'email' => 'required|string|unique:users',
                'password' => 'required|string|min:8',
                'company_id_number' => 'required',
                'company_address' => 'required',
                'country_id' => 'required',
                'country_code' => 'required',
                'phone_number' => 'required',
                'account_type' => 'required|in:operator,charterer',
            ];



            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }
             if ($request->has('country_code', 'phone_number')) {
                $is_exist = User::query()->where('country_code', $request->country_code)

                    ->where('phone_number', $request->phone_number)->count();
                if ($is_exist > 0) return $this->sendErrors(__('custom_messages.user.phone_number_exist'), 400);
            }

            $image = null;
            if ($request->hasFile('image')) $image = Utilities::upload(request()->image, 'users');

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'company_id_number' => $request->company_id_number,
                'password' => Hash::make($request->password),
                'company_address' => $request->company_address,
                'country_id' => $request->country_id,
                'country_code' => $request->country_code,
                'phone_number' => $request->phone_number,
                'image' => $image,
                'account_type' => $request->account_type,
             ]);
            $user->save();

            $user2 = User::where('id', $user->id)

                ->first();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addMonths(36);





            return $this->sendSuccessResponse([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'user' => $user2,

            ]);
        } catch (\Exception $ex) {
            dd($ex);

            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }

    public function login(Request $request)
    {
        try {


            $rules = [
                'email' => 'required|email',
                'password' => 'required|string',
            ];


            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }
            $credentials = $request->only(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return $this->sendErrors(
                    trans('auth.failed'),
                    400
                );
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addMonths(34);
            $token->save();




            return $this->sendSuccessResponse([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'user' => $user,

            ]);
        } catch (\Exception $ex) {
            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }







    public function sendCode(Request $request)
    {
        $code = 200;
        $rules = [
            'email' => 'required|email'
        ];
        $vr = $this->validateRequest($request, $rules);
        if ($vr['status'] === false) {
            return $this->sendErrors($vr['errors'], 400);
        }
        try {

            $code = 200;
            $user = User::query()->where('email', $request->email)->first();
            ResetPassword::query()->where('email', $request->email)->delete();
            $restPassword = ResetPassword::query()->create(['email' => $request->email, 'code' => mt_rand(1001, 9999)]);
            \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\ResetPassword\sendCode($restPassword));



            return $this->sendSuccessResponse(['status_send' => true], 200, 'code has been sent');
        } catch (\Exception $ex) {
          

            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }

    public function verifyCode(Request $request)
    {
        $code = 200;
        $rules = [
            'code' => 'required',
            'email' => 'required|email'
        ];
        $vr = $this->validateRequest($request, $rules);
        if ($vr['status'] === false) {
            return $this->sendErrors($vr['errors'], 400);
        }
        try {


            $get_code = ResetPassword::query()->where('code', $request->code)->where('email', $request->email)
                ->where('status', false)
                ->orderBy('created_at', 'desc')->first();
            if (!is_null($get_code)) {
                $get_code->status = true;
                $get_code->save();
                return $this->sendSuccessResponse(['status_check' => true], 200);
            } else {
                return $this->sendSuccessResponse(['status_check' => false], 200);
            }
        } catch (\Exception $ex) {
            $code = 500;
            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }


    public function checkData(Request $request)
    {
        try {
            // 'user_name' => null,
            $dataToCheck = [
                'email' => null,

                'phone_number' => null,
                'company_id_number' => null,
            ];

            $lang = 'en';
            $dataToCheck['messages'] = [];
            if (\request()->has('lang')) {
                $lang =   \request('lang');
            }

            $code = 200;
            if (isset($request->email)) {
                $is_exist = User::query()->where('email', $request->email)->count();
                if ($is_exist > 0) {
                    $dataToCheck['email'] = false;
                    $code = 400;
                    if ($lang == 'ar') {
                        array_push($dataToCheck['messages'], 'البريد الالكتروني غير متاح');
                    } else {
                        array_push($dataToCheck['messages'], 'Email is not available');
                    }
                } else {
                    $dataToCheck['email'] = true;
                }
            }
            if (isset($request->company_id_number)) {
                $is_exist = User::query()
                ->where('account_type',$request->account_type)
                ->where('company_id_number', $request->company_id_number)->count();
                if ($is_exist > 0) {
                    $dataToCheck['company_id_number'] = false;
                    $code = 400;
                    if ($lang == 'ar') {
                        array_push($dataToCheck['messages'], 'معرف  غير متاح');
                    } else {
                        array_push($dataToCheck['messages'], 'Id  is not available');
                    }
                } else {
                    $dataToCheck['company_id_number'] = true;
                }
            }
        
            if (isset($request->phone_number)) {
                $is_exist = User::query()->where('phone_number', $request->phone_number)

                    ->where('country_code', $request->country_code)

                    ->count();
                if ($is_exist > 0) {
                    $dataToCheck['phone_number'] = false;
                    $code = 400;
                    if ($lang == 'ar') {
                        array_push($dataToCheck['messages'], ' رقم الجوال غير متاح');
                    } else {
                        array_push($dataToCheck['messages'], 'Phone number is not available');
                    }
                } else {
                    $dataToCheck['phone_number'] = true;
                }
            }
            return $this->sendSuccessResponse($dataToCheck, 200, $dataToCheck['messages']);
        } catch (\Exception $ex) {
            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }








    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        UserToken::where('user_id', $request->user()->id)->delete();

        return $this->sendSuccessResponse(null, 200, 'Successfully logged out');
    }









    public function changeImage(Request $request)
    {
        try {
                  $rules = [
                'image' => 'required|file',
                'type' => 'required|in:profile,background',
            ];
            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }
            $user = $request->user();
            if ($request->hasFile('image')) {
                $path = Utilities::upload($request->image, ucfirst($user->account_type));
            }
             if($request->type == "profile"){
               
                $user->image = $path ?? $user->image;

            } else {
                $user->background_image = $path  ;
            }
         
            $user->save();



            return  $this->sendSuccessResponse(['user' => $user], 200, __('custom_messages.general.updated'));
        } catch (\Exception $exception) {
            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'c_password' => 'required|min:8|same:new_password',
        ];
        $vr = $this->validateRequest($request, $rules);
        if ($vr['status'] === false) {
            return $this->sendErrors($vr['errors'], 400);
        }
        try {
            $user = $request->user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return $this->sendSuccessResponse(null, 200, __('custom_messages.user.password.changed_successfully'));
            }

            return $this->sendErrors(__('custom_messages.user.password.changed_un_successfully'), 400);
        } catch (\Exception $ex) {
            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }




    public function resetPassword(Request $request)
    {
        $rules = [
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ];
        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'Messages' => $validator->getMessageBag()], 400);
        }
        try {
            $user = $this->getAuthenticatedUser();
            if (!is_null($user)) {
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['status' => true, 'Messages' => 'Password Updated Successfully'], 200);
            }
            return response()->json(['status' => false, 'Messages' => 'User Not Found '], 404);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'Messages' => $ex->getMessage()], 500);
        }
    }
}
