<?php

namespace App\Http\Controllers\Api\UserTokens;

use App\Http\Controllers\JWTController;
use App\Models\UserToken;
use App\Traits\GeneralFunction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserTokensController
{
    use GeneralFunction;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));
    }

    public function store(Request $request)
    {
        try {
        $rules =[
            'token'=>'required|unique:user_tokens',
        ];

        $res_v = $this->validateRequest( $request,$rules);
        if ($res_v['status'] === false) {
            return $this->sendErrors($res_v['errors']);
        }
        $data = $request->only('token');

        $res_v = $this->validateRequest( $request,$rules);
        if ($res_v['status'] === false) {
            return $this->sendErrors($res_v['errors'],400);
        }

            $user = auth('api')->user();
            $data['user_id']= $user->id;
            $data['current_lang']= $user->current_lang;
            $res = UserToken::query()->updateOrCreate($data,$data);
           return  $this->sendSuccessResponse($res,200,__('custom_messages.general.added'));
        }
        catch (\Exception $ex) {
            return $this->sendErrors(__('custom_messages.general.internal_server_error'),500);

        }
    }
    public function getTokens()
    {
        try {
            $user = auth()->user();
            $tokens = UserToken::query()->where('user_id',$user->id)->pluck('token');
            return  $this->sendSuccessResponse($tokens,200);
        }
        catch (\Exception $ex) {
            return $this->sendErrors(__('custom_messages.general.internal_server_error'),500);
        }
    }

}
