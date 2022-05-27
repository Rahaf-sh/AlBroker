<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoType extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'media_path',
        'name_ar',
        'name_en',
        'parent_id',
        'is_deleted'
    ];


    protected $hidden = [
        'created_at', 'updated_at', "parent_id", 'number', 'media_path',
        "is_deleted"
    ];

    protected $with = ['details', 'usd', 'euro'];


    public function details()
    {
        return $this->hasMany(CargoTypeDetails::class, 'cargo_type_id', 'id')->orderByDesc('id');
    }

    public function usd()
    {
        return $this->hasOne(CargoTypeDetails::class, 'cargo_type_id', 'id')->where('unit', 'usd')->orderByDesc('id');
    }

    public function euro()
    {
        return $this->hasOne(CargoTypeDetails::class, 'cargo_type_id', 'id')->where('unit', 'euro')->orderByDesc('id');
    }

}
