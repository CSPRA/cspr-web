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
	            $table->integer('userId')->unsigned()->index();
                $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
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
        //
        Schema::drop('doctors');

    }
}
