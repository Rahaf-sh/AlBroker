<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_deleted',
        'country_id'

    ];
    protected $hidden= [
        'created_at','updated_at','is_deleted'
    ];

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
