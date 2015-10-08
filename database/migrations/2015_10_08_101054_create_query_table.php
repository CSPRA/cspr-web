<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('query', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('formId')->unsigned()->index();
            $table->foreign('formId')->references('id')->on('detection_form')->onDelete('cascade');
            
            $table->integer('sectionId')->unsigned()->nullable();
            $table->foreign('sectionId')->references('id')->on('sections')->onDelete('set null');
            $table->integer('order');

            $table->integer('questionId')->unsigned();
            $table->foreign('questionId')->references('id')->on('questions')->onDelete('cascade');


            $table->enum('questionType', array('text', 'number','boolean','single choice','multiple choice'));

            $table->integer('optionGroupId')->unsigned()->nullable();
            $table->foreign('optionGroupId')->references('id')->on('option_groups')->onDelete('cascade');
            
            $table->text('units')->nullable();

            $table->integer('parentQueryId')->unsigned()->nullable();
            $table->foreign('parentQueryId')->references('id')->on('query')->onDelete('cascade'); 

            $table->unique(array('sectionId','order','parentQueryId'));
           
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
        Schema::drop('query');
    }
}
