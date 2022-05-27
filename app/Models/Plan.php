<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        "number",
        "media_path",
        "name_ar",
        "desc_ar",
        "desc_en",
        "name_en",
        "parent_id",
        "is_deleted",
        "price",
        "period_per_month",
        "from_",
        "to_",
        "type"
    ];
    public function plans()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
