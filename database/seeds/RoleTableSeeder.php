<?php

use Illuminate\Database\Seeder;

use App\Role;

class RoleTableSeeder extends Seeder
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
            exit('I just stopped you getting fired. Love, Amo.');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        DB::table('users')->truncate();

        DB::table('roles')->truncate();
        Role::create([
            'id'            => 1,
            'name'          => 'root',
            'description'   => 'Use this account with extreme caution. When using this account it is possible to cause irreversible damage to the system.'
        ]);
        Role::create([
            'id'            => 2,
            'name'          => 'admin',
            'description'   => 'Full access to create users with lower roles and can access to all the database table'
        ]);
        Role::create([
            'id'            => 3,
            'name'          => 'staff',
            'description'   => 'Able to approve volunteer and doctor registation, to assign tasks to volunteers, to assign doctor to patients, to view screening and registration reports'
        ]);
        Role::create([
            'id'            => 4,
            'name'          => 'doctor',
            'description'   => 'Able to see patient information, volunteers public information and can rate them'
        ]);
        Role::create([
            'id'            => 5,
            'name'          => 'volunteer',
            'description'   => 'Able to register and screen patients and assign them doctors'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
