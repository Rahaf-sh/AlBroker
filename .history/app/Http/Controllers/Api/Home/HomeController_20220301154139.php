<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Items;
use App\Traits\GeneralFunction;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vessel;

class HomeController extends Controller
{
    use GeneralFunction;
    public function __construct()
    {
        $this->changeLang(request()->header('lang-app'));
    }

    public function home()
    {
        
        
            try {
                // ->where('type', 'main')-
                $data['recent_cargo'] = Cargo::query()->whereNull('working_status')->orderByDesc('id');
                $data['recent_vessel'] = Vessel::query()->where('is_deleted', 0)->orderByDesc('id');
                $data['recent_feed'] = [];
    
    
    
                $data['recent_cargo'] =  request('with_paginate_recent_cargo') == 'yes' ?  $data['recent_cargo']->paginate(8, ['*'], 'recent_cargo') : $data['recent_cargo']->get();
                $data['recent_vessel'] =  request('with_paginate_recent_vessel') == 'yes' ?  $data['recent_vessel']->paginate(8, ['*'], 'recent_vessel') : $data['recent_vessel']->get();
                $data['recent_feed'] =  request('with_paginate_recent_feed') == 'yes' ?  [] : [];
             
                 return $this->sendSuccessResponse($data);
    
            } catch (\Exception $ex) {
                return $this->sendErrors($ex,500);
          
            }
        }


       

}
