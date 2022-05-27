<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'is_deleted'

    ];
    protected $hidden= [
        'created_at','updated_at','is_deleted'
    ];

    public function citties()
    {
        return $this->hasMany(City::class,'country_id','id');
    }
}
