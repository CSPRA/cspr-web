<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatientHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {     
        Schema::create('patient_history', function (Blueprint $table) {
            
            $table->integer('patientId')->unsigned()->index();
            $table->foreign('patientId')->references('id')->on('patients')->onDelete('cascade');

            $table->integer('eventId')->unsigned();
            $table->foreign('eventId')->references('id')->on('events')->onDelete('cascade');

            $table->integer('registeredBy')->unsigned();
            $table->foreign('registeredBy')->references('id')->on('users')->onDelete('cascade');

            $table->integer('screeningId')->unsigned()->nullable(); 
            $table->foreign('screeningId')->references('id')->on('screenings')->onDelete('set null');

            $table->enum('diagnosis_status',array('Pending','Normal','Beginning','Precancer','Suspicious','Detected'));  

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('patient_history');

    }
}
