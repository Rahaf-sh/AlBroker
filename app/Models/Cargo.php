<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;


    protected $table = 'cargos';
    protected $fillable = [
        "cargo_type_id",
        "is_deleted",
        "quantity",
        "quantity_unit",
        "stowage_factor",
        "landing_port_country_id",
        "landing_port_name",
        "discharging_port_country_id",
        "discharging_port_name",
        "lay_can_start_date",
        "lay_can_canceling_date",
        "try_vessel_date",
        "loading_rate",
        "loading_rate_unit",
        "discharging_rate",
        "discharging_unit",
        "additional_cargo_details",
        "special_requests",
        "fright_idea",
        "fright_idea_unit",
        "working_status",
        "address_commission",
        "charterer_id",
        "vessel_id",
        "operator_id",
        "cargo_status",

        "type",
        "charter_file",
        "operator_file",
        "final_file",
        "offer_status",
        "parent_id",
        "final_offer_id",
        "cargo_type_details_id"
    ];

    protected $hidden = [
        "publisher_status",
        "offer_status",
        "is_deleted"
    ];



    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id', 'id');
    }

    public function charter()
    {
        return $this->belongsTo(User::class, 'charterer_id', 'id');
    }

    public function vessel()
    {
        return $this->belongsTo(Vessel::class, 'vessel_id', 'id');
    }

    public function landing_port_country()
    {
        return $this->belongsTo(Country::class, 'landing_port_country_id', 'id');
    }

    public function discharging_port_country()
    {
        return $this->belongsTo(Country::class, 'discharging_port_country_id', 'id');
    }

    public function cargo_type()
    {
        return $this->belongsTo(CargoType::class, 'cargo_type_id', 'id');
    }

    public function cargo_type_details()
    {
        return $this->belongsTo(CargoTypeDetails::class, 'cargo_type_details_id', 'id');
    }



     
    

    protected $appends = [
        "full_path_charter_file",
        "full_path_operator_file",
        "full_path_final_file",
        "is_interested"
    ];



    public function getIsInterestedAttribute()  : ? bool
    {
        $default = null;
    
        if(auth('api')->check()){
            $int= CargoInterested::query()->where('cargo_id',$this->id)->where('interester_id',auth('api')->user()->id??0)->first();
            if(!is_null($int)){
                    return $int->type == "add" ;
            }
          }
        return $default;
    }
    public function getFullPathCharterFileAttribute()
    {
         
        if(is_null($this->charter_file))return null ;
        return request()->getSchemeAndHttpHost() . '/storage/' . $this->charter_file;
    }
    public function getFullPathOperatorFileAttribute()
    {

        if(is_null($this->operator_file))return null ;
        return request()->getSchemeAndHttpHost() . '/storage/' . $this->operator_file;
    }
    public function getFullPathFinalFileAttribute()
    { 
        if(is_null($this->final_file))return null ;
        return request()->getSchemeAndHttpHost() . '/storage/' . $this->final_file;
    }
}
