<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetectionFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detection_form', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->integer('cancerId')->unsigned()->index();
            $table->foreign('cancerId')->references('id')->on('cancer_types')->onDelete('cascade');
            $table->integer('createdBy')->unsigned()->nullable();
            $table->foreign('createdBy')->references('id')->on('users')->onDelete('set null');
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
        Schema::drop('detection_form');
    }
}
