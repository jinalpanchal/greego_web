<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverShippingAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_shipping_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id', $autoIncrement = false )->unsigned();
            $table->string('street',200)->nullable();
            $table->string('apt', 200)->nullable();
            $table->string('city',64)->nullable();
            $table->integer('zipcode', $autoIncrement = false )->unsigned(); 
            $table->string('state', 64)->nullable();
            $table->timestamps();
        });
        Schema::table('driver_shipping_address', function($table) {
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
        Schema::dropIfExists('driver_shipping_address');
    }
}
