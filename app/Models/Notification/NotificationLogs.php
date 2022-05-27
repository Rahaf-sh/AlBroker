<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

class NotificationLogs extends Model
{
    protected $fillable = [
        'notification_id',
        'number_sent_to',
        'number_success',
        'number_failure',
        'number_modification',
        'tokens_to_delete',
        'tokens_to_modify',
        'tokens_to_retry',
        'tokens_with_errors',
    ];

    public function notification(){
        return $this->belongsTo(Notification::class,'notification_id','id');
    }
}
