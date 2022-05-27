<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationProfiles extends Model
{
    use HasFactory;


    protected $fillable = [
        "follower_id",
        "followed_id",
    ];
}
