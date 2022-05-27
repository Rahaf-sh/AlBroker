<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportMesages extends Model
{
    use HasFactory;
    protected $fillable = [
        "report_type",
        "message",
        "on_model_name",
        "on_model_id",
        "from_model_name",
        "from_model_id",
        "status",
    ];

    public const MESSAGE_STATUS_LIST = [
        [
            "name_ar"=>"جديد",
            "name_en"=>"New",
            "status_value"=>0,
        ],
        [
            "name_ar"=>"مقروئة",
            "name_en"=>"Readed",
            "status_value"=>1,
        ],
          
        
    ];


  public const TYPE_LIST = [
        [
            "name_ar"=>"ابلاغ عن منتج",
            "name_en"=>"Report on Product",
            "status_value"=>1,
        ],
         
          
        
    ];

    public function sender()
    {
        return $this->belongsTo(User::class,'from_model_id','id');
    }
    public function on_item()
    {
        return $this->belongsTo(Items::class,'on_model_id','id');
    }
}
