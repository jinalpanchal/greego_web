<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverBankInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_bank_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id', $autoIncrement = false )->unsigned();
            $table->string('routing_number',20 )->nullable(); 
            $table->string('account_number',20)->nullable();
            $table->timestamps();
        });
        Schema::table('driver_bank_info', function($table) {
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
        Schema::dropIfExists('driver_bank_info');
    }
}
