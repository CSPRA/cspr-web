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

            $table->integer('cancerId')->unsigned();
            $table->foreign('cancerId')->references('id')->on('cancer_types')->onDelete('cascade');

            $table->integer('formId')->unsigned()->nullable();
            $table->foreign('formId')->references('id')->on('detection_form')->onDelete('set null');            
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
        //
        Schema::drop('screenings');
    }
}
