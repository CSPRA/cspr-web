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
                $table->string('name');
                $table->integer('groupId')->unsigned()->index();
                $table->foreign('groupId')->references('id')->on('optionGroups')->onDelete('cascade');                $table->timestamps();
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
