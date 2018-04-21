<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', $autoIncrement = false )->unsigned();
            $table->integer('user_vehicle_id', $autoIncrement = false )->unsigned(); 
            $table->string('from_address',200)->nullable();
            $table->float('from_lat');
            $table->float('from_lng'); 
            $table->string('to_address',200)->nullable();
            $table->float('to_lat');
            $table->float('to_lng'); 
            $table->smallInteger('total_estimated_travel_time', $autoIncrement = false )->unsigned(); 
            $table->smallInteger('total_estimated_trip_cost', $autoIncrement = false )->unsigned(); 
            $table->smallinteger('request_status', $autoIncrement = false )->unsigned(); 
            $table->timestamps();
        });
        //By float() method Its return double datatype so alter table with float datatype
        \DB::statement('ALTER TABLE requests MODIFY COLUMN from_lat float;');
        \DB::statement('ALTER TABLE requests MODIFY COLUMN from_lng float;');
        \DB::statement('ALTER TABLE requests MODIFY COLUMN to_lat float;');
        \DB::statement('ALTER TABLE requests MODIFY COLUMN to_lng float;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
