<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralText extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'title_ar',
        'media_path',
        'content',
        'content_ar',
    
        'email',
    ];
    protected $appends = ["full_path"];
    public function getFullPathAttribute()
       {
           return request()->getSchemeAndHttpHost().'/storage/'.$this->media_path;
       }
}
