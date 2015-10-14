<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('event_assignments', function (Blueprint $table) {
            
            $table->integer('eventId')->unsigned()->index();
            $table->foreign('eventId')->references('id')->on('events')->onDelete('cascade');

            $table->integer('volunteerId')->unsigned();
            $table->foreign('volunteerId')->references('userId')->on('volunteers')->onDelete('cascade'); 

            $table->date('startingDate');
            $table->date('endingDate');

            $table->unique(array('eventId','volunteerId'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_assignments');
    }
}
