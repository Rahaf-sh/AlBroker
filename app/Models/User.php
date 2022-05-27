<?php

namespace App\Models;

use App\Models\Notification\NotificationProfiles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "image",
        "email",
        "password",
        "country_id",
        "city_id",
        "country_code",
        "phone_number",
        "account_status",
        "account_type",
        "user_type",
        "rate",
        "points",
        "company_id_number",
        "company_address",
        "background_image",
       


    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',

        'remember_token',

        "account_status",
        "lat",
        "long",
        "city_id",


    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];

    public const ACCOUNT_STATUS = [
        "active",
        "disabled",
        "pending",
    ];



















    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', "id");
    }

    public function country_country()
    {
        return $this->belongsTo(Country::class, 'company_country_id', "id");
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', "id");
    }

    protected $appends = ["image_full_path","background_image_full_path"];

    public function getImageFullPathAttribute()
    {
        return request()->getSchemeAndHttpHost() . '/storage/' . $this->image;
    } 
    public function getBackgroundImageFullPathAttribute()
    {
        return request()->getSchemeAndHttpHost() . '/storage/' . $this->background_image;
    }
    
}


