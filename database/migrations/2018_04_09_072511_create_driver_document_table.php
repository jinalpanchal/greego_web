<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_document', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id', $autoIncrement = false )->unsigned();
            $table->text('verification_document');
            $table->text('autoissurance_document');
            $table->text('homeissurance_document');
            $table->text('uberpaycheck_document');
            $table->timestamps();
        });
        Schema::table('driver_document', function($table) {
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
        Schema::dropIfExists('driver_document');
    }
}
