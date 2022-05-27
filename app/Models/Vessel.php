<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "imo",
        "email",
        "operator_name",
        "main_image",
        "operator_id",
        "is_deleted",
        "status",
        "ship_over_view",
        "ship_over_view",
        "principal_dimemsions",
        "tonnage",
        "load_line_infomation",
        "hold_capacities_cbm_cft",
        "type",
        "call_sign",
        "flag",
        "port_of_register",
        "class_society",

        "year_of_bulid",
        "gross_tonnage",
        "net_tonnage",
        "dead_weight",
        "length",
        "beam",
        "depth",
        "owners",
        "operators",
    ];

    protected $hidden = [
        "is_deleted",
       
         
    ];

    public function operator()
    {
        return  $this->belongsTo(User::class, 'operator_id', 'id');
    }
    public function media()
    {
        return $this->hasMany(VesselMedia::class, 'vessel_id', 'id');
    }


    protected $appends = ["full_path"];
    public function getFullPathAttribute()
    {
        return request()->getSchemeAndHttpHost() . '/storage/' . $this->main_image;
    }
}
