<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsaRates extends Migration
{    
    public function up()
    {                
        Schema::create('usa_rates',function(Blueprint $table){
            $table->increments('id');
            $table->integer('usa_state_id', $autoIncrement = false )->unsigned();;
            $table->float('base_fee');
            $table->float('time_fee');
            $table->float('mile_fee');
            $table->float('cancel_fee');
            $table->float('overmile_fee');
            $table->timestamps();
        });
         Schema::table('usa_rates', function($table) {
            $table->foreign('usa_state_id', $autoIncrement = false )->unsigned()->references('id')->on('usa_states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usa_rates');
    }
}
