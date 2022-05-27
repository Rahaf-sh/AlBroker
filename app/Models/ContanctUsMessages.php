<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContanctUsMessages extends Model
{
    use HasFactory;

    protected $fillable = [
        "chat_id",
        "sender_client_id",
        "sender_replyer_id",
        "message",
        "subject",
        "email",
        "file",
        "is_deleted",
        "is_seen",
        "reply_to_message_id",
    ];

    protected $hidden = [
        "chat_id",
        "is_deleted",
        "is_seen",
        "created_at",
    ];
    protected $with = [
        'reply_message',
        'reply_message.replyer'
    ];



    public function sender()
    {
        return $this->belongsTo(User::class,'sender_client_id','id');
    }
 public function replyer()
    {
        return $this->belongsTo(User::class,'sender_replyer_id','id');
    }

    public function reply_message()
    {
        return $this->belongsTo(self::class,'reply_to_message_id','id');
    }

   
}
