<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification\Notification;
use App\Models\Notification\NotificationProfiles;
use App\Traits\GeneralFunction;
use Illuminate\Http\Request;

class NotificationProfilesController extends Controller
{
    use GeneralFunction ;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));
    }


    public function list()
    {
        {
            try {
                 $count_unseen = Notification::query()->where('is_deleted',0)->where('receiver_id',auth('api')->user()->id??0)->where('status',0)->count();
    
                $notifications = Notification::query()->where('is_deleted',0)->where('receiver_id',auth('api')->user()->id??0)->orderByDesc('id')->orderByDesc('status')->paginate(8) ;
                return $this->sendSuccessResponse(["notifications"=>$notifications,'count_unseen'=>$count_unseen]);
    
            } catch (\Exception $ex) {
                return $this->sendErrors($ex,500);
          
            }
        }
    }




    public function storeOrDestroy(Request $request)
    {
      $rules =  [ 
            
            "followed_id"=>"required",
            "operation_type"=>"required",
            
            
      ];

      $vr = $this->validateRequest($request, $rules);
      if ($vr['status'] === false) {
          return $this->sendErrors($vr['errors'], 400);
      }


    try {
        $data = $request->only("followed_id");
        $data["follower_id"]=     $request->user()->id ??0;
  
        if ($request->operation_type == 1) {
          NotificationProfiles::query()->updateOrCreate($data,$data);
          return $this->sendSuccessResponse(null,200,__("custom_messages.general.added"));

        }else {
            NotificationProfiles::query()->where([
                ["follower_id","=",$data["follower_id"]],
                ["followed_id","=",$data["followed_id"]],
         
                ])->delete();
                return $this->sendSuccessResponse(null,200,__("custom_messages.general.deleted"));
        }
        
        } catch (\Exception $ex) {
            return $this->sendErrors($ex,500);
      
        }

      
    } 
    
    
    public function read(Request $request)
    {
      $rules =  [ 
            
            "ids"=>"required",
             
            
      ];

      $vr = $this->validateRequest($request, $rules);
      if ($vr['status'] === false) {
          return $this->sendErrors($vr['errors'], 400);
      }


    try {
        
  
      
          Notification::query()->whereIn('id',$request->ids)->where('receiver_id',auth('api')->user()->id??0)->update(["status"=>1]);
          return $this->sendSuccessResponse(null,200,__("custom_messages.general.updated"));

       
        



        } catch (\Exception $ex) {
            return $this->sendErrors($ex,500);
      
        }

      
    }
}
