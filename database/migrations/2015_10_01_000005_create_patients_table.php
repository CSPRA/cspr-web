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
			$table->string('homePhoneNumber')->nullable();
            $table->string('mobileNumber');
            $table->string('email')->nullable();

            $table->integer('annualIncome');
            $table->string('occupation');
            $table->enum('education',array('University','College','Professional School','Higher Secondary','Secondary School','Primary School','NA'));
            $table->string('religion');
            $table->integer('aliveChildrenCount');
            $table->integer('deceasedChildrenCount');

            $table->string('voterId')->nullable();
            $table->string('adharId')->nullable();
            $table->unique( array('voterId','adharId'));

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
