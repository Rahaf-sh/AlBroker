<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;

    protected $fillable = [

        "working_status",
        "secure_code",
        "is_active",
        "payment_brand_id",
        "payment_brand_name",
        "fee",
        "payment_details",
        "payment_response",
        "payment_code",
        "payment_message",
        "price",
        "user_id",
        "plan_id",
        "expire_at",
        "secure_code_status",

    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class,'plan_id','id')->where('is_deleted',0);
    }
}
