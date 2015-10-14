<?php

use Illuminate\Database\Seeder;
use App\Event;
use Carbon\Carbon;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          if (App::environment() === 'production') {
            exit('Do not seed in production environment');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints

        DB::table('events')->truncate();
        
        Event::create([
            'id'            => 1,
            'name'          => 'Spot Registration For Throat Cancer',
            'cancerId'      => 1,
            'startDate'		=> Carbon::now(),
            'endDate'		=> Carbon::now()->addMonths(12),
            'eventType'		=> 'register',
            'formId'		=> null,
        ]);

        Event::create([
            'id'            => 2,
            'name'          => 'Spot Screening For Throat Cancer',
            'cancerId'      => 1,
            'startDate'		=> Carbon::now(),
            'endDate'		=> Carbon::now()->addMonths(12),
            'eventType'		=> 'screen',
            'formId'		=> 1,
        ]);
        
        Event::create([
            'id'            => 3,
            'name'          => 'Spot Registration For Skin Cancer',
            'cancerId'      => 2,
            'startDate'		=> Carbon::now(),
            'endDate'		=> Carbon::now()->addMonths(12),
            'eventType'		=> 'register',
            'formId'		=> null,
        ]);


        Event::create([
            'id'            => 3,
            'name'          => 'Registration cum Screening camp for Throat Cancer',
            'cancerId'      => 1,
            'startDate'		=> Carbon::now(),
            'endDate'		=> Carbon::now()->addWeeks(1),
            'eventType'		=> 'register_screen',
            'formId'		=> 1,
        ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints

    }
}
