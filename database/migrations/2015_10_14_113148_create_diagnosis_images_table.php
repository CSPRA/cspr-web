<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosisImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_images', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('screeningId')->unsigned()->index();
            $table->foreign('screeningId')->references('id')->on('screenings')->onDelete('cascade');

            $table->text('description')->nullable();
            $table->string('imageName');

            $table->unique(array('screeningId','imageName')); 
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
        Schema::drop('diagnosis_images');
    }
}
