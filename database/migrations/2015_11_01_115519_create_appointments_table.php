 <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
          Schema::create('appointments', function (Blueprint $table) {
                $table->increments('id')->index()->unique();

                $table->integer('doctorId')->unsigned();
                $table->foreign('doctorId')->references('userId')->on('doctors')->onDelete('cascade');
                
                $table->integer('screeningId')->unsigned();
                $table->foreign('screeningId')->references('id')->on('screenings')->onDelete('cascade');

                $table->integer('requestedBy')->unsigned();
                $table->foreign('requestedBy')->references('id')->on('users')->onDelete('cascade');

                $table->date('date')->nullable();
                $table->time('time')->nullable();
                $table->unique(array('doctorId','screeningId'));
                $table->enum('status',array('Pending','Scheduled','Finished'));
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
        Schema::drop('appointments');
    }
}
