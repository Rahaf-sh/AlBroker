<?php

namespace App\Models\Notification;

use App\Models\Category;
use App\Models\Items;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
    protected $fillable = [
        'sender_id',
        'target_id',
        'receiver_id',
        'body_en',
        'body_ar',
        'status',
        'title_ar',
        'title_en',
        'type',
      
        'category_id',
  
    ];
    protected $with =[
        'sender',
        'receiver',

    ];

    protected $hidden = [
        'created_at', 'updated_at', "parent_id", 'number',
        'media_path', 
        "is_deleted",
        'body_ar',
        'title_ar',
        'type',
        'item_id',
     ];





    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }
 
 


    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }

 }
