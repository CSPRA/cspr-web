<?php

use Illuminate\Database\Seeder;
use App\OptionGroup;

class OptionGroupTableSeeder extends Seeder
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

        DB::table('option_groups')->truncate();
        
        OptionGroup::create([
            'id'            => 1,
            'name'          => 'Habit Status',
            'sectionId'     => 1,
        ]);
        OptionGroup::create([
            'id'            => 2,
            'name'          => 'Non-Veg Foods',
            'sectionId'     => 1,
        ]);
        OptionGroup::create([
            'id'            => 3,
            'name'          => 'Junk Foods',
            'sectionId'     => 1,
        ]);
        OptionGroup::create([
            'id'            => 4,
            'name'          => 'Chronic Diseases',
            'sectionId'     => 2,
        ]);
        OptionGroup::create([
            'id'            => 5,
            'name'          => 'Menstural Information',
            'sectionId'     => 3,
        ]);
    	
    	OptionGroup::create([
            'id'            => 6,
            'name'          => 'Familiy Planning Methods',
            'sectionId'     => 3,
        ]);

        OptionGroup::create([
            'id'            => 7,
            'name'          => 'Clinical Investigations',
            'sectionId'     => 3,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints

    }
}
