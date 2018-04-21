<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverlocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driverlocation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id', $autoIncrement = false )->unsigned();
            $table->float('lat');
            $table->float('lng');
            $table->timestamps();
        });
        //By float() method Its return double datatype so alter table with float datatype
        \DB::statement('ALTER TABLE driverlocation MODIFY COLUMN lat float;');
        \DB::statement('ALTER TABLE driverlocation MODIFY COLUMN lng float;');

        Schema::table('driverlocation', function($table) {
            $table->foreign('driver_id', $autoIncrement = false )->unsigned()
                    ->references('id')->on('drivers')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('driverlocation');
    }
}
