<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Volunteer;

class UserTableSeeder extends Seeder
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
        DB::table('users')->truncate();

        User::create([
            'id'            => 1,
            'name'          => 'admin',
            'email'			=> 'admin@gmail.com',
            'password' 		=> '$2y$10$zJxQkCB6UNr9zzLIgve71ekLMEcOWue/lKuyCtunV559qN2NDV1ra',
            'roleId'        => 2
        ]);

        User::create([
            'id'            => 2,
            'name'          => 'volunteer1',
            'email'         => 'volunteer1@gmail.com',
            'password'      => '$2y$10$zJxQkCB6UNr9zzLIgve71ekLMEcOWue/lKuyCtunV559qN2NDV1ra',
            'roleId'        => 5
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
