<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model {

    protected $table = 'user_card';
    protected $fillable = ['user_id', 'card_number', 'exp_month_year','zipcode'];
    
}
