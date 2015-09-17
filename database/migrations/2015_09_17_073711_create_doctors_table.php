<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		 Schema::create('doctors', function (Blueprint $table) {
	            $table->increments('doctorId');
	            $table->string('username')->unique();
	            $table->string('email')->unique();
	            $table->string('password', 60);
				$table->string('firstname'),
				$table->string('lastname'),
				$table->string('contactNumber'),
				$table->bool('isVerified'),
	            $table->rememberToken();
	            $table->timestamps();
	        });
    }

	public function specialization()
	    {
	        return $this->hasOne('App\Disease');
	    }
		public function specialization()
		    {
		        return $this->hasOne('App\Phone');
		    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('doctors');

    }
}
