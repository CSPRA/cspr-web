<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('response', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('screeningId')->unsigned()->index();
            $table->foreign('screeningId')->references('id')->on('screenings')->onDelete('cascade');

            $table->integer('queryId')->unsigned();
            $table->foreign('queryId')->references('id')->on('query')->onDelete('cascade');

            $table->text('textAnswer')->nullable();
            $table->decimal('numberAnswer')->nullable();
            $table->boolean('boolAnswer')->nullable();
            
            $table->unique(array('screeningId','queryId'));
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
        Schema::drop('response');
    }
}
