<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->nullable();
            $table->string('lastname',64)->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();             
            $table->string('contact_number',15);            
            $table->string('city',64)->nullable();
            $table->text('profile_pic')->nullable();
            $table->string('promocode',64)->nullable();
            $table->string('legal_firstname',64)->nullable();
            $table->string('legal_middlename',64)->nullable();
            $table->string('legal_lastname',64)->nullable();   
            $table->string('social_security_number',64)->nullable();  
            $table->boolean('is_sedan')->nullable()->defualt(0);
            $table->boolean('is_suv')->nullable()->defualt(0);
            $table->boolean('is_van')->nullable()->defualt(0);
            $table->boolean('is_auto')->nullable()->defualt(0);
            $table->boolean('is_manual')->nullable()->defualt(0);            
            $table->tinyInteger('current_status')->nullable()->default(0);
            $table->boolean('verified')->default(0);     
            $table->boolean('is_iphone')->default(0);
            $table->boolean('is_agreed')->default(0);
            $table->smallInteger('profile_status')->default(0);            
            $table->smallInteger('is_approve')->default(0);    // 0 = pending, 1 = approved, 2 = rejected       
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
        Schema::dropIfExists('drivers');
    }

}
