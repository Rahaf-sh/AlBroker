<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContanctUsChat extends Model
{
    use HasFactory;

protected $fillable = [
    "owner_id",
"is_deleted",
];

    public static function getUserChat($user_id)
    {
        //check if user has cart
        $chat = self::query()->where('owner_id', $user_id)->where('is_deleted',0)
            ->firstOrCreate(['owner_id' => $user_id],['owner_id' => $user_id]);
        $chat = self::find($chat->id);

        return  $chat;
    }


    public function messages()
    {
        return $this->hasMany(ContanctUsMessages::class,'chat_id','id')->orderByDesc('created_at');
    }
    public function getMessages()
    {
        return $this->messages()->paginate(50);
    }
}
