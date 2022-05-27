<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VesselMedia extends Model
{
    use HasFactory;



    protected $fillable = [
        "media_path",
        "media_type",
        "vessel_id"
    ];


    protected $hidden = [
        "media_type",
        "created_at",
        "updated_at",
    ];

    protected $appends = ["full_path"];
    public function getFullPathAttribute()
    {
        return request()->getSchemeAndHttpHost() . '/storage/' . $this->media_path;
    }
    
}
