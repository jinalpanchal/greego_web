<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_manufacturer_id',false)->unsigned();
            $table->string('model',64);
            $table->timestamps();
        });
        Schema::table('vehicles', function($table) {
            $table->foreign('vehicle_manufacturer_id', $autoIncrement = false )->unsigned()->references('id')->on('vehicle_manufacturers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
