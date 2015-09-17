<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('patients', function (Blueprint $table) {
            $table->increments('patientId');
            $table->string('name');
			$table->date('dob');
			$table->enum('gender', array('male', 'female'));
			$table->string('address');
			$table->string('phoneNumbers');
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
