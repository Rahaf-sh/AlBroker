<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoTypeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        "unit",
        "min_",
        "max_",
        "comission_",
        "cargo_type_id",
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
        "parent_id",
        "comission_",
        'number',
        'media_path',
        "is_deleted"
    ];
}



