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
            $table->increments('id')->index();
            $table->string('name');
			$table->date('dob');
			$table->enum('gender', array('male', 'female'));
            $table->enum('maritalStatus',array('single','married','divorced','widowed'));
			$table->string('address');
			$table->string('homePhoneNumber');
            $table->string('mobileNumber');
            $table->string('email');

            $table->integer('annualIncome');
            $table->string('occupation');
            $table->string('education');
            $table->string('religion');
            $table->integer('aliveChildrenCount');
            $table->integer('deceasedChildrenCount');

            $table->integer('registeredBy')->unsigned();
            $table->foreign('registeredBy')->references('userId')->on('volunteers')->onDelete('cascade');
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
        {
            Schema::drop('patients');            
        }

    }
}
