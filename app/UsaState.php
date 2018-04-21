<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsaState extends Model
{
    protected  $table = "usa_states";
    public function rates() {
         return $this->HasOne('App\UsaRates');
    }
}
