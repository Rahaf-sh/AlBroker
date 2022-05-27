<?php

namespace App\Http\Controllers\Api\Profile;

use App\Core\Helpers\Utilities;
use App\Http\Controllers\BaseApiController;

use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserToken;


class ProfileController extends BaseApiController
{


























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
            if ($request->type == "profile") {

                $user->image = $path ?? $user->image;
            } else {
                $user->background_image = $path ??     $user->background_image;
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
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'c_password' => 'required|min:6|same:new_password',
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




    public function updateProfile(Request $request)
    {
        try {
            $rules = [

                'email' => 'required|email|unique:users,email,' . $request->user()->email,






            ];


            $vr = $this->validateRequest($request, $rules);
            if ($vr['status'] === false) {
                return $this->sendErrors($vr['errors'], 400);
            }

            $data = [




                'email' => $request->email,
            ];



            $user = User::find($request->user()->id);
            if (is_null($user)) return $this->sendErrors(__('custom_messages.general.not_found'), 400);
            $user->update($data);

            $user2 = User::where('id', $user->id)->first();









            return $this->sendSuccessResponse([

                'user' => $user2,

            ]);
        } catch (\Exception $ex) {
            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }




    public function resetPassword(Request $request)
    {
        $rules = [
            'password' => 'required|min:6',
            'code' => 'required',

            'c_password' => 'required|same:password',
        ];



        $vr = $this->validateRequest($request, $rules);
        if ($vr['status'] === false) {
            return $this->sendErrors($vr['errors'], 400);
        }

        try {

            $user = User::query()->where('email', $request->email)
                ->first();

            $get_code = ResetPassword::query()->where('code', $request->code)->where('email', $request->email)
                ->where('status', true)
                ->orderBy('created_at', 'desc')->first();


            if (!is_null($user) && !is_null($get_code)) {
                $user->password = Hash::make($request->password);
                $user->save();

                UserToken::where('user_id', $user->id)->delete();
                return $this->sendSuccessResponse(null, 200, __('custom_messages.user.password.changed_successfully'));
            }
            return $this->sendErrors(null, 400, __('custom_messages.user.password.changed_un_successfully'));
        } catch (\Exception $ex) {
            return $this->sendErrors(null, 400, __('custom_messages.user.password.changed_un_successfully'));
        }
    }





    public function changeLangApp(Request $request)
    {
        $rules = [
            'current_lang' => 'required|in:en,ar'

        ];
        $vr = $this->validateRequest($request, $rules);
        if ($vr['status'] === false) {
            return $this->sendErrors($vr['errors'], 400);
        }
        try {
            $user = $request->user();
            $user->current_lang = $request->current_lang;
            $user->save();
            UserToken::query()->where('user_id', $user->id)->update(['current_lang' => $request->current_lang]);







            return $this->sendSuccessResponse($user, 200, __('custom_messages.general.updated'));
        } catch (\Exception $ex) {

            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }




    public function user2(Request $request)
    {

        try {

            $user = User::query()->find($request->user_id);






            return $this->sendSuccessResponse(['user' => $user]);
        } catch (\Exception $ex) {


            return $this->sendErrors(__('custom_messages.general.internal_server_error'), 500);
        }
    }





    public function changeStatus($status, Request $request)
    {
        $user =  $request->user();
        if ($status == 'disable') {

            $user->account_status = 'disabled';
        }
        if ($status == 'delete') {

            $user->account_status = 'deleted';
            $user->email .= '***deleted';
            $user->phone_number .= '***deleted';
            $user->company_id_number .= '***deleted';
            $user->is_deleted = 1;
        }
        $user->save();
        return $this->sendSuccessResponse(null, 200);
    }
}
