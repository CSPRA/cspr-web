<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('patientId')->unsigned()->index();
            $table->foreign('patientId')->references('id')->on('patients')->onDelete('cascade');

            $table->integer('volunteerId')->unsigned();
            $table->foreign('volunteerId')->references('userId')->on('volunteers')->onDelete('cascade');

            $table->integer('eventId')->unsigned();
            $table->foreign('eventId')->references('id')->on('events')->onDelete('cascade');
                     
            $table->unique(array('patientId','volunteerId','eventId'));
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
        Schema::drop('diagnosis_images');
        Schema::drop('response');
        Schema::drop('patient_history');

        Schema::drop('screenings');
    }
}
