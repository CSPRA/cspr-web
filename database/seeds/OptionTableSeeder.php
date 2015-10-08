<?php

use Illuminate\Database\Seeder;
use App\Option;

class OptionTableSeeder extends Seeder
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

        DB::table('options')->truncate();

        /**
		*  Options for group: Habit Status
        */
        
        Option::create([
            'id'            => 1,
            'name'          => 'Yes',
            'groupId'       => 1,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 2,
            'name'          => 'No',
            'groupId'       => 1,
            'order'			=> 2,
        ]);

        Option::create([
            'id'            => 3,
            'name'          => 'Ex',
            'groupId'       => 1,
            'order'			=> 3,
        ]);

        /**
		*  Options for group: Non-Veg Foods
        */
        Option::create([
            'id'            => 4,
            'name'          => 'Eggs',
            'groupId'       => 2,
            'order'			=> 1,        
        ]);
        Option::create([
            'id'            => 5,
            'name'          => 'Fresh Fish',
            'groupId'       => 2,
            'order'			=> 2,
        ]);
    	Option::create([
            'id'            => 6,
            'name'          => 'Dry Fish',
            'groupId'       => 2,
            'order'			=> 3,
        ]);
        Option::create([
            'id'            => 7,
            'name'          => 'Meat',
            'groupId'       => 2,
            'order'			=> 4,
		]);
        Option::create([
            'id'            => 8,
            'name'          => 'Beef',
            'groupId'       => 2,
            'order'			=> 5,
        ]);

        /**
		*  Options for group: Junk Foods
        */

        Option::create([
            'id'            => 9,
            'name'          => 'Pizzas/ Burgers',
            'groupId'       => 3,
            'order'			=> 1,        
        ]);
        Option::create([
            'id'            => 10,
            'name'          => 'Fries/ Bhajjis',
            'groupId'       => 3,
            'order'			=> 2,
        ]);
    	Option::create([
            'id'            => 11,
            'name'          => 'Soda/ Cola',
            'groupId'       => 3,
            'order'			=> 3,
        ]);
        Option::create([
            'id'            => 12,
            'name'          => 'Other Junk Food',
            'groupId'       => 3,
            'order'			=> 4,
		]);

		/**
		*  Options for group: Chronic Diseases
        */
             
        Option::create([
            'id'            => 13,
            'name'          => 'Diabetes',
            'groupId'       => 4,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 14,
            'name'          => 'BP',
            'groupId'       => 4,
            'order'			=> 2,
        ]);
        
        Option::create([
            'id'            => 15,
            'name'          => 'TB',
            'groupId'       => 4,
            'order'			=> 3,
        ]);
        
        Option::create([
            'id'            => 16,
            'name'          => 'Heart Diseases',
            'groupId'       => 4,
            'order'			=> 4,
        ]);

		Option::create([
            'id'            => 17,
            'name'          => 'Cancer',
            'groupId'       => 4,
            'order'			=> 5,
        ]);
		Option::create([
            'id'            => 18,
            'name'          => 'Others Diseases',
            'groupId'       => 4,
            'order'			=> 6,
        ]);

        /**
		*  Options for group: Menstural Information
        */

        Option::create([
            'id'            => 19,
            'name'          => 'Cycle Regular',
            'groupId'       => 5,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 20,
            'name'          => 'Discharge PV',
            'groupId'       => 5,
            'order'			=> 2,
        ]);
        
        Option::create([
            'id'            => 21,
            'name'          => 'Post Menopausal Bleeding',
            'groupId'       => 5,
            'order'			=> 3,
        ]);
        
        Option::create([
            'id'            => 22,
            'name'          => 'Post Coital Bleeding',
            'groupId'       => 5,
            'order'			=> 4,
        ]);

		Option::create([
            'id'            => 23,
            'name'          => 'Inter Menstrual Bleeding',
            'groupId'       => 5,
            'order'			=> 5,
        ]);

        /**
		*  Options for group: Familiy Planning Methods
        */

        Option::create([
            'id'            => 24,
            'name'          => 'Loop',
            'groupId'       => 6,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 25,
            'name'          => 'Pills',
            'groupId'       => 6,
            'order'			=> 2,
        ]);
        
        Option::create([
            'id'            => 26,
            'name'          => 'Tubectomy',
            'groupId'       => 6,
            'order'			=> 3,
        ]);
        
        Option::create([
            'id'            => 27,
            'name'          => 'Vasectomy',
            'groupId'       => 6,
            'order'			=> 4,
        ]);

		Option::create([
            'id'            => 28,
            'name'          => 'Other methods',
            'groupId'       => 6,
            'order'			=> 5,
        ]);

        /**
		*  Options for group: Clinical Investigations
        */
    
        Option::create([
            'id'            => 29,
            'name'          => 'ECG',
            'groupId'       => 7,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 30,
            'name'          => 'Chest X Ray',
            'groupId'       => 7,
            'order'			=> 2,
        ]);
        
        Option::create([
            'id'            => 31,
            'name'          => 'BA Swallow',
            'groupId'       => 7,
            'order'			=> 3,
        ]);
        
        Option::create([
            'id'            => 32,
            'name'          => 'FNAC',
            'groupId'       => 7,
            'order'			=> 4,
        ]);

		Option::create([
            'id'            => 33,
            'name'          => 'Biopsy',
            'groupId'       => 7,
            'order'			=> 5,
        ]);

		Option::create([
            'id'            => 34,
            'name'          => 'PAP Smear',
            'groupId'       => 7,
            'order'			=> 6,
        ]);

		Option::create([
            'id'            => 35,
            'name'          => 'ECTO',
            'groupId'       => 7,
            'order'			=> 7,
        ]);
        Option::create([
            'id'            => 36,
            'name'          => 'ENDO',
            'groupId'       => 7,
            'order'			=> 8,
        ]);
        Option::create([
            'id'            => 37,
            'name'          => 'Post FX',
            'groupId'       => 7,
            'order'			=> 9,
        ]);		

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
