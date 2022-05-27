<?php

namespace App\Traits;

use App\Models\Items;
use App\Models\Notification\Notification;
use App\Models\Notification\NotificationLogs;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Facades\App;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Response\DownstreamResponse;

trait NotificationTrait
{
    public function sendNotification(array $dataNotification, $notification_id)
    {
        if (count($dataNotification['tokens']) === 0) {
            return false;
        }
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($dataNotification['title']);
        $notificationBuilder->setBody($dataNotification['body'])
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['additional_data' => $dataNotification['additional_data']]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::sendTo($dataNotification['tokens'], $option, $notification, $data);

        return $this->handle_results($downstreamResponse, $notification_id, count($dataNotification['tokens']));
    }

    public function handle_results(DownstreamResponse $downstreamResponse, $notification_id, $num_sent_to)
    {
        if (!$downstreamResponse) {
            return false;
        }
        $numberSuccess = $downstreamResponse->numberSuccess();
        $numberFailure = $downstreamResponse->numberFailure();
        $numberModification = $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $tokensToDelete = $downstreamResponse->tokensToDelete();
        UserToken::query()->whereIn('token',$tokensToDelete)->delete();

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $tokensToModify = $downstreamResponse->tokensToModify();
        foreach ($tokensToModify as $key => $token) {
            UserToken::query()->where('token',$key)->update(['token'=>$token]);

        }

        // return Array - you should try to resend the message to the tokens in the array
        $tokensToRetry = $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
        $tokensWithError = $downstreamResponse->tokensWithError();

        $log = NotificationLogs::create([
            'notification_id' => $notification_id,
            'number_sent_to' => $num_sent_to,
            'number_success' => $numberSuccess,
            'number_failure' => $numberFailure,
            'number_modification' => $numberModification,
            'tokens_to_delete' => json_encode($tokensToDelete),
            'tokens_to_modify' => json_encode($tokensToModify),
            'tokens_to_retry' => json_encode($tokensToRetry),
            'tokens_with_errors' => json_encode($tokensWithError),
        ]);

        return true;
    }

    public function notificationToArray($noti): array
    {
        $lang = App::getLocale();
        $data = [];

        $data['title'] = $noti['title_'.$lang];
        $data['body'] = $noti['body_'.$lang];
        $data['tokens'] = User::getTokens($noti->receiver_id??0) ?? [];

        return $data;
    }

    public function sendMessageChat($message, $token)
    {
        if (count($token)===0) {
          return false;
        }
        $notificationBuilder = new PayloadNotificationBuilder('new message');
        $notificationBuilder->setBody($message->message)
            ->setSound('default');
        $notification = $notificationBuilder->build();
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([
            'type_notification' => 'chat',
            'message_information' => $message, ]);

        $option = $optionBuilder->build();
        $data = $dataBuilder->build();
        $res = FCM::sendTo($token, $option, $notification, $data);

        return true;
    }


    public function generaretNotifications($users_ids,$item_id,$owner_id,$notificationInfo)
    {
        try{
        $tokens = UserToken::query()->whereIn('user_id',$users_ids)->get();
 
        $data = [];
        foreach ($users_ids as $user_id) {
            $data [] = [
                'sender_id'=>$owner_id,
                'receiver_id'=>$user_id,
                'body_en'=>$notificationInfo['body_en'],
                'body_ar'=>$notificationInfo['body_ar'],
                'title_ar'=>$notificationInfo['title_ar'],
                'title_en'=>$notificationInfo['title_en'],
                'item_id'=>$item_id,
                'category_id'=>$notificationInfo["category_id"],
                'owner_item_id'=>$owner_id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }
        Notification::insert($data);
        

        $tokens_ar = $tokens->where('current_lang','ar')->pluck('token')->toArray();
        $tokens_en = $tokens->where('current_lang','en')->pluck('token')->toArray();

        
      if(count($tokens_ar)) $this->sendFCMByLang('ar',$notificationInfo,$tokens_ar,$item_id,$owner_id);
      if(count($tokens_en))$this->sendFCMByLang('en',$notificationInfo,$tokens_en,$item_id,$owner_id);
       
        return true;}
        catch (\Exception $exception){
            
        }
    }


public function sendFCMByLang($lang,$notificationInfo,$tokens,$item_id,$owner_id)
{
 
    try {
     
        if (count($tokens) == 0) {
            return false;
        }
      
    $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($notificationInfo['title_'.$lang]);
        $notificationBuilder->setBody($notificationInfo['body_'.$lang])
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['additional_data' => ["item_id"=>$item_id,"owner_item_id"=>$owner_id]]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        //   $this->handle_results($downstreamResponse, $notificationInfo, count($tokens)); 
         return true;
    }
    catch (\Exception $ex){
        

    }
}
}
