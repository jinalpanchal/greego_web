<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->nullable();
            $table->string('email',64)->nullable();
            $table->string('lastname',64)->nullable();
            $table->string('contact_number',64)->unique();
            $table->string('city',64)->nullable();
            $table->text('profile_pic')->nullable();
            $table->string('promocode',64)->nullable();
            $table->boolean('verified')->default(0);
            $table->boolean('is_iphone')->default(0);
            $table->boolean('is_agreed')->default(0);
             $table->text('device_id')->nullable();  //Device Id for push notification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
