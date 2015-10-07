<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('options', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->integer('order');
                $table->integer('groupId')->unsigned()->index();
                $table->foreign('groupId')->references('id')->on('option_groups')->onDelete('cascade');
                $table->unique(array('order', 'groupId'));
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
        Schema::drop('options');

    }
}
