<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Volunteer;

class VolunteerTableSeeder extends Seeder
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
        DB::table('volunteers')->truncate();

        Volunteer::create([
            'userId'        => 3,
            'firstname'		=> 'volunteer1',
            'lastname'      => 'volunteer1',
            'contactNumber' => '9717017651',
            'isVerified'    => true
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
