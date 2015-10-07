<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('optionGroups', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('sectionId')->unsigned()->index()->nullable();
                $table->foreign('sectionId')->references('id')->on('sections')->onDelete('set null');                $table->timestamps();
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
         Schema::drop('optionGroups');

    }
}
