<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    protected $fillable = [
        'name', 'email', 'contact_number', 'lastname', 'city', 'profile_pic', 'promocode', 'verified', 'is_iphone','is_deactivated'
    ];

    public function cards() {
        return $this->HasMany('App\UserCard');
    }

    public function vehicles() {
        return $this->HasMany('App\UserVehicle');
    }


    public function avatar() {
//        return 'http://kroslinkstech.in/greego/storage/app/' . $this->profile_pic;
        if($this->profile_pic){
            
            return 'http://'.env('APP_URL_WITHOUT_PUBLIC') .'/storage/app/' . $this->profile_pic;
        }else{
            return '';
            
        }
    }
    // First method uses accessors
//    public function getProfile_picAttribute($value)
//    {
//        return 'http://innoviussoftware.com/greego/'.$value;
//    }

}
