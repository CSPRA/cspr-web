<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('staffs', function (Blueprint $table) {
	            $table->increments('staffId');
	            $table->string('username')->unique();
	            $table->string('email')->unique();
	            $table->string('password', 60);
				$table->string('firstname');
				$table->string('lastname');
				$table->string('contactNumber');
				$table->boolean('isVerified');
	            $table->rememberToken();
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
        //public function down()
	    {
	        //
	        Schema::drop('staffs');
	    }
    }
}
