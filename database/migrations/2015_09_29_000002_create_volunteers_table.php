<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      	 Schema::create('volunteers', function (Blueprint $table) {
                $table->integer('userId')->unsigned()->index()->unique();
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
        Schema::drop('volunteers');
    }
}
