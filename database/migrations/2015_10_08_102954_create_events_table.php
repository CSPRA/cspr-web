<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            
            $table->integer('cancerId')->unsigned()->index();
            $table->foreign('cancerId')->references('id')->on('cancer_types')->onDelete('cascade');

            $table->date('startDate');
            $table->date('endDate');

            $table->enum('eventType',array('register','screen','register_screen'));

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
        Schema::drop('events');
    }
}
