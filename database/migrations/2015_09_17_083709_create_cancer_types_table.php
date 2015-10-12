<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCancerTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		 Schema::create('cancer_types', function (Blueprint $table) {
	            $table->increments('id');
	            $table->string('name')->unique();
	            $table->string('description');
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
        Schema::drop('cancer_types');

    }
}
