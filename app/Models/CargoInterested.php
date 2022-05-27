<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoInterested extends Model
{
    use HasFactory;
    protected $fillable = [
        "interested_id",
        "interester_id",
        "cargo_id",
        "type",
        "vessel_id",
    ];



}
