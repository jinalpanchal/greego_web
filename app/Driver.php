<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Driver extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    protected $table = 'drivers';
    protected $fillable = ['name', 'email', 'contact_number', 'lastname', 'city', 'profile_pic', 'promocode', 'dob', 'legal_firstname', 'legal_middlename', 'legal_lastname',
        'social_security_number', 'is_sedan', 'is_suv', 'is_van', 'is_auto', 'is_manual', 'current_status', 'verified', 'profile_status','is_approve'
    ];

    public function shipping_address() {
        return $this->hasOne('App\DriverShippingAddress');
    }
    
    public function documents() {
        return $this->hasOne('App\DriverDocument');
    }
    public function bank_information() {
        return $this->hasOne('App\DriverBankInfo');
    }
    public function avatar() {
//        return 'http://kroslinkstech.in/greego/storage/app/' . $this->profile_pic;
         return 'http://'.$_SERVER['HTTP_HOST'].'/greego/storage/app/' . $this->profile_pic;
    }

}
