<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', $autoIncrement = false )->unsigned();
            $table->integer('vehicle_id', $autoIncrement = false )->unsigned();
            $table->smallinteger('year', $autoIncrement = false )->nullable();
            $table->string('color',64)->nullable();
            $table->smallInteger('type')->default(0)->nullable(); // 0 = sedan, 1 = suv, 2 = van
            $table->string('transmission_type',64)->nullable(); //0 = manual, 1 = auto
            $table->boolean('selected')->default(0); //0 = manual, 1 = auto
            $table->timestamps();
        });
        
        Schema::table('user_vehicles', function($table) {
            $table->foreign('user_id', $autoIncrement = false )->unsigned()->references('id')->on('users');
            $table->foreign('vehicle_id', $autoIncrement = false )->unsigned()->references('id')->on('vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vehicles');
    }
}
