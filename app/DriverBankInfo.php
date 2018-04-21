<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DriverBankInfo extends Model {

    protected $table = 'driver_bank_info';
    protected $fillable = ['driver_id', 'routing_number', 'account_number'];
}
