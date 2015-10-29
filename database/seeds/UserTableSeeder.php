<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Volunteer;
use App\Doctor;

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
        DB::table('volunteers')->truncate();
        DB::table('doctors')->truncate();

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

        User::create([
            'id'            => 3,
            'name'          => 'Arun',
            'email'         => 'doctor1@gmail.com',
            'password'      => '$2y$10$zJxQkCB6UNr9zzLIgve71ekLMEcOWue/lKuyCtunV559qN2NDV1ra',
            'roleId'        => 4
        ]);

         User::create([
            'id'            => 4,
            'name'          => 'Biswas',
            'email'         => 'doctor2@gmail.com',
            'password'      => '$2y$10$zJxQkCB6UNr9zzLIgve71ekLMEcOWue/lKuyCtunV559qN2NDV1ra',
            'roleId'        => 4
        ]);

        User::create([
            'id'            => 5,
            'name'          => 'Sunil',
            'email'         => 'doctor3@gmail.com',
            'password'      => '$2y$10$zJxQkCB6UNr9zzLIgve71ekLMEcOWue/lKuyCtunV559qN2NDV1ra',
            'roleId'        => 4
        ]);

        User::create([
            'id'            => 6,
            'name'          => 'volunteer2',
            'email'         => 'volunteer2@gmail.com',
            'password'      => '$2y$10$zJxQkCB6UNr9zzLIgve71ekLMEcOWue/lKuyCtunV559qN2NDV1ra',
            'roleId'        => 5
        ]);

        Volunteer::create([
            'userId'        => 3,
            'firstname'     => 'volunteer1',
            'lastname'      => 'volunteer1',
            'contactNumber' => '9717017651',
            'isVerified'    => true
        ]);

        Volunteer::create([
            'userId'        => 6,
            'firstname'     => 'volunteer2',
            'lastname'      => 'volunteer2',
            'contactNumber' => '9717017650',
            'isVerified'    => true
        ]);
        
        Doctor::create([
            'userId'        => 3,
            'firstname'     => 'Arun',
            'lastname'      => 'Jain',
            'contactNumber' => '9717017650',
            'specialization'=> 1,
            'location'      => 'Delhi',
            'isVerified'    => true
            ]);
       
        Doctor::create([
            'userId'        => 4,
            'firstname'     => 'Biswas',
            'lastname'      => 'Rao',
            'contactNumber' => '9717017651',
            'specialization'=> 2,
            'location'      => 'Bangalore',
            'isVerified'    => true
            ]);

        Doctor::create([
            'userId'        => 5,
            'firstname'     => 'Sunil',
            'lastname'      => 'Jain',
            'contactNumber' => '9717017651',
            'specialization'=> 2,
            'location'      => 'Bangalore',
            'isVerified'    => true
            ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
       
    }
}
