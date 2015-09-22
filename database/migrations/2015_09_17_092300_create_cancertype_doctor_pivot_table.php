<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancerTypeDoctorPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancerType_doctor', function(Blueprint $table) {
            $table->integer('cancertype_id')->unsigned()->index();
            $table->foreign('cancertype_id')->references('id')->on('cancerTypes')->onDelete('cascade');
            $table->integer('doctor_id')->unsigned()->index();
            $table->foreign('doctor_id')->references('doctorId')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cancerType_doctor');
    }
}
