<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_card', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', $autoIncrement = false )->unsigned();
            $table->string('card_number',25)->nullable();
            $table->string('exp_month_year',10)->nullable();
//            $table->smallInteger('exp_month')->unsigned()->nullable();
//            $table->smallInteger('exp_year')->unsigned()->nullable();
            $table->smallInteger('cvv_number', $autoIncrement = false )->unsigned();
            $table->integer('zipcode', $autoIncrement = false )->unsigned(); 
            $table->timestamps();
        });
        Schema::table('user_card', function($table) {
            $table->foreign('user_id', $autoIncrement = false )->unsigned()->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_card');
    }
}
