<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DriverDocument extends Model {

    protected $table = 'driver_document';
    protected $fillable = ['driver_id', 'verification_document', 'autoissurance_document','homeissurance_document','uberpaycheck_document'];
     
}
