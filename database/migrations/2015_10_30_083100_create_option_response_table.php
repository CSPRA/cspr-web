<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_response', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('responseId')->unsigned();
            $table->foreign('responseId')->references('id')->on('response')->onDelete('cascade');
            
            $table->integer('optionGroupId')->unsigned()->nullable();
            $table->foreign('optionGroupId')->references('id')->on('option_groups')->onDelete('set null');

            $table->integer('optionId')->unsigned()->nullable();
            $table->foreign('optionId')->references('id')->on('options')->onDelete('set null');
            
            $table->unique(array('responseId','optionGroupId','optionId'));
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
        Schema::drop('option_response');
    }
}
