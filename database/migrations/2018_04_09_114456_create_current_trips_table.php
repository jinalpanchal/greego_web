<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id', $autoIncrement = false )->unsigned();
            $table->integer('user_id', $autoIncrement = false )->unsigned(); 
            $table->integer('driver_id', $autoIncrement = false )->unsigned(); 
            $table->string('status',200)->nullable();
            $table->integer('actual_trip_amount', $autoIncrement = false )->unsigned();
            $table->integer('tip_amount', $autoIncrement = false )->unsigned(); 
            $table->string('total_trip_amount',200)->nullable();
            $table->integer('actual_trip_travel_time', $autoIncrement = false )->unsigned();
            $table->tinyInteger('payment_status')->unsigned(); 
            $table->integer('trip_driver_rating', $autoIncrement = false )->unsigned(); 
            $table->integer('trip_user_rating', $autoIncrement = false )->unsigned(); 
            $table->timestamps();
        });
        
        Schema::table('current_trips', function($table) {
            $table->foreign('request_id', $autoIncrement = false )->unsigned()->references('id')->on('requests');
            $table->foreign('user_id', $autoIncrement = false )->unsigned()->references('id')->on('users');
            $table->foreign('driver_id', $autoIncrement = false )->unsigned()->references('id')->on('drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_trips');
    }
}
