<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_ar',
        'country_id'
    ];

    protected $hidden= [
        'created_at','updated_at','is_deleted'
    ];

    public function Country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
