<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('ratings', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('givenBy')->unsigned()->index();
                $table->foreign('givenBy')->references('id')->on('users')->onDelete('cascade');

                $table->integer('givenTo')->unsigned()->index();
                $table->foreign('givenTo')->references('id')->on('users')->onDelete('cascade');

                $table->integer('ratingValue');
                
                $table->unique(array('givenBy', 'givenTo'));
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
    }
}
