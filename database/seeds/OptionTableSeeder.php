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
        *   Options for group: Food Preferences
        */
        Option::create([
            'id'            => 4,
            'name'          => 'Veg',
            'groupId'       => 2,
            'order'         => 1,
        ]);

        Option::create([
            'id'            => 5,
            'name'          => 'Non-Veg',
            'groupId'       => 2,
            'order'         => 2,
        ]);
        /**
		*  Options for group: Non-Veg Foods
        */
        Option::create([
            'id'            => 6,
            'name'          => 'Eggs',
            'groupId'       => 3,
            'order'			=> 1,        
        ]);
        Option::create([
            'id'            => 7,
            'name'          => 'Fresh Fish',
            'groupId'       => 3,
            'order'			=> 2,
        ]);
    	Option::create([
            'id'            => 8,
            'name'          => 'Dry Fish',
            'groupId'       => 3,
            'order'			=> 3,
        ]);
        Option::create([
            'id'            => 9,
            'name'          => 'Meat',
            'groupId'       => 3,
            'order'			=> 4,
		]);
        Option::create([
            'id'            => 10,
            'name'          => 'Beef',
            'groupId'       => 3,
            'order'			=> 5,
        ]);

        /**
		*  Options for group: Junk Foods
        */

        Option::create([
            'id'            => 9,
            'name'          => 'Pizzas/ Burgers',
            'groupId'       => 4,
            'order'			=> 1,        
        ]);
        Option::create([
            'id'            => 10,
            'name'          => 'Fries/ Bhajjis',
            'groupId'       => 4,
            'order'			=> 2,
        ]);
    	Option::create([
            'id'            => 11,
            'name'          => 'Soda/ Cola',
            'groupId'       => 4,
            'order'			=> 3,
        ]);
        Option::create([
            'id'            => 12,
            'name'          => 'Other Junk Food',
            'groupId'       => 4,
            'order'			=> 4,
		]);

		/**
		*  Options for group: Chronic Diseases
        */
             
        Option::create([
            'id'            => 13,
            'name'          => 'Diabetes',
            'groupId'       => 5,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 14,
            'name'          => 'BP',
            'groupId'       => 5,
            'order'			=> 2,
        ]);
        
        Option::create([
            'id'            => 15,
            'name'          => 'TB',
            'groupId'       => 5,
            'order'			=> 3,
        ]);
        
        Option::create([
            'id'            => 16,
            'name'          => 'Heart Diseases',
            'groupId'       => 5,
            'order'			=> 4,
        ]);

		Option::create([
            'id'            => 17,
            'name'          => 'Cancer',
            'groupId'       => 5,
            'order'			=> 5,
        ]);
		Option::create([
            'id'            => 18,
            'name'          => 'Others Diseases',
            'groupId'       => 5,
            'order'			=> 6,
        ]);

        /**
		*  Options for group: Menstural Information
        */

        Option::create([
            'id'            => 19,
            'name'          => 'Cycle Regular',
            'groupId'       => 6,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 20,
            'name'          => 'Discharge PV',
            'groupId'       => 6,
            'order'			=> 2,
        ]);
        
        Option::create([
            'id'            => 21,
            'name'          => 'Post Menopausal Bleeding',
            'groupId'       => 6,
            'order'			=> 3,
        ]);
        
        Option::create([
            'id'            => 22,
            'name'          => 'Post Coital Bleeding',
            'groupId'       => 6,
            'order'			=> 4,
        ]);

		Option::create([
            'id'            => 23,
            'name'          => 'Inter Menstrual Bleeding',
            'groupId'       => 6,
            'order'			=> 5,
        ]);

        /**
		*  Options for group: Familiy Planning Methods
        */

        Option::create([
            'id'            => 24,
            'name'          => 'Loop',
            'groupId'       => 7,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 25,
            'name'          => 'Pills',
            'groupId'       => 7,
            'order'			=> 2,
        ]);
        
        Option::create([
            'id'            => 26,
            'name'          => 'Tubectomy',
            'groupId'       => 7,
            'order'			=> 3,
        ]);
        
        Option::create([
            'id'            => 27,
            'name'          => 'Vasectomy',
            'groupId'       => 7,
            'order'			=> 4,
        ]);

		Option::create([
            'id'            => 28,
            'name'          => 'Other methods',
            'groupId'       => 7,
            'order'			=> 5,
        ]);

        /**
		*  Options for group: Clinical Investigations
        */
    
        Option::create([
            'id'            => 29,
            'name'          => 'ECG',
            'groupId'       => 8,
            'order'			=> 1,
        ]);

        Option::create([
            'id'            => 30,
            'name'          => 'Chest X Ray',
            'groupId'       => 8,
            'order'			=> 2,
        ]);
        
        Option::create([
            'id'            => 31,
            'name'          => 'BA Swallow',
            'groupId'       => 8,
            'order'			=> 3,
        ]);
        
        Option::create([
            'id'            => 32,
            'name'          => 'FNAC',
            'groupId'       => 8,
            'order'			=> 4,
        ]);

		Option::create([
            'id'            => 33,
            'name'          => 'Biopsy',
            'groupId'       => 8,
            'order'			=> 5,
        ]);

		Option::create([
            'id'            => 34,
            'name'          => 'PAP Smear',
            'groupId'       => 8,
            'order'			=> 6,
        ]);

		Option::create([
            'id'            => 35,
            'name'          => 'ECTO',
            'groupId'       => 8,
            'order'			=> 7,
        ]);
        Option::create([
            'id'            => 36,
            'name'          => 'ENDO',
            'groupId'       => 8,
            'order'			=> 8,
        ]);
        Option::create([
            'id'            => 37,
            'name'          => 'Post FX',
            'groupId'       => 8,
            'order'			=> 9,
        ]);		

        /**
        *  Options for group: Feeding Methods
        */
    
        Option::create([
            'id'            => 38,
            'name'          => 'Breast Feeding',
            'groupId'       => 9,
            'order'         => 1,
        ]);
        Option::create([
            'id'            => 39,
            'name'          => 'Bottle Feeding',
            'groupId'       => 9,
            'order'         => 2,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
