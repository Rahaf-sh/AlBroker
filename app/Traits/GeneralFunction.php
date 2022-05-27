<?php


namespace App\Traits;

use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

trait GeneralFunction
{
    /**
     * change Language
     * @param $lang
     */
    public function changeLang($lang)
    {
        if ($lang === 'ar') {
            App::setLocale('ar');
        } else {
            App::setLocale('en');
        }
    }

    /**
     * get local language
     * @return string
     */
    public function getLang(): string
    {
        return App::getLocale();
    }






    /**
     * @param array $arrayErrors
     * @return array
     */
    public function customErrorsMessages(array $arrayErrors): array
    {
        $errors = [];
        foreach ($arrayErrors as $key => $item) {

            array_push($errors, $item[0]);
        }

        return  $errors;
    }


    public function sendErrors($messages, $code = 400)
    {
        if (is_array($messages)) {
            $messages = $this->customErrorsMessages($messages);
        } else {
            $messages = [$messages];
        }
        return response()->json(['status' => false, 'messages' => $messages], $code);
    }

    public function sendSuccessResponse($data, $code = 200, $msg = null)
    {
        $res = ['status' => true, 'data' => $data];

        $res['messages'] = [];
        if (is_null($msg)) $msg = [];
        if (is_string($msg))
            array_push($res['messages'], $msg);
        else   $res['messages'] = $msg;

        return response()->json($res, $code);
    }


    public function validateRequest(Request $request, array $rules)
    {
        $data['status'] = true;
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $data['errors'] = $validator->errors()->getMessages();
            $data['status'] = false;
        } else {
            $data['errors'] = [];
            $data['status'] = true;
        }
        return $data;
    }







    /**
     * @param $typeUser
     * @param mixed ...$types
     * @return bool
     */
    public function checkUser($typeUser, ...$types): bool
    {
        return in_array($typeUser, $types, true);
    }




    public function getActivePlan($user_id)
    {
         UserPlan::query()->where('expire_at', '<', now()->format('Y-m-d'))
     
            ->update([
                "is_active" => 0,
                "working_status" => 0
            ]);
        return  UserPlan::query()->where('working_status', 1)->where('expire_at', '>=', now()->format('Y-m-d'))
        ->whereHas('plan')
            ->where('user_id', $user_id)->first();
    }
}
