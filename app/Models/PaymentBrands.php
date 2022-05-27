<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentBrands extends Model
{
    use HasFactory;


    protected $fillable = [
        "name",
        "name_ar",
        "media_path",
    ];


    protected $hidden =[
        "created_at" ,
        "updated_at" ,
        "is_deleted" 
    ];
    protected $appends = ["full_path"];
    public function getFullPathAttribute()
       {
           return request()->getSchemeAndHttpHost().'/storage/'.$this->media_path;
       }
}
