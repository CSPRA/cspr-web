<?php

use Illuminate\Database\Seeder;
use App\Assignment;
use Carbon\Carbon;


class EventAssignmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          if (App::environment() === 'production') {
            exit('Do not seed in production environment');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        DB::table('event_assignments')->truncate();

        Assignment::create([
            'eventId'            => 2,
            'volunteerId'        => 2,
            'startingDate'		   => Carbon::now(),
            'endingDate'         => Carbon::now()->addWeeks(2)
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
