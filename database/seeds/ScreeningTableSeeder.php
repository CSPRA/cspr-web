<?php

use Illuminate\Database\Seeder;

use App\Screening;

class ScreeningTableSeeder extends Seeder
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
        DB::table('screenings')->truncate();
        Screening::create([
            'id'            => 1,
            'patientId'     => 1,
            'volunteerId'   => 2,  
            'eventId'       => 2
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
