<?php

use Illuminate\Database\Seeder;

use App\Section;

class SectionTableSeeder extends Seeder
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
        DB::table('sections')->truncate();

        Section::create([
            'id'            => 1,
            'name'          => 'Lifestyle Habits',
            'description'   => 'This section focuses on lifestyle and habits of a patient']);
        Section::create([
            'id'            => 2,
            'name'          => 'Family History',
            'description'   => 'This section focuses on medical history of family of a patient']);
        Section::create([
            'id'            => 3,
            'name'          => 'Complaints',
            'description'   => 'This section deals with recent complaints of pateint']);
        Section::create([
            'id'            => 4,
            'name'          => 'Clinical Examination',
            'description'   => 'This section deals with various clinical reports of a patient']);
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
