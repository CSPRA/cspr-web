<?php

use Illuminate\Database\Seeder;
use App\Response;

class ResponseTableSeeder extends Seeder
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
        DB::table('response')->truncate();
        DB::table('option_response')->truncate();
       
        /**
		*  Do you smoke?
        */
        
        Response::create([
            'id'            => 1,
            'screeningId'   => 1,
            'queryId'	    => 1,	
            	
        ]);

        $option = array(
          'responseId' => 1,
          'optionGroupId' => 1,
          'optionId'    => 1
          );

        DB::table('option_response')->insert($option);

        /**
		*  Do you chew?
        */
		Response::create([
            'id'            => 2,
            'screeningId'   => 1,
            'queryId'	    => 2
        ]);
      $option = array(
          'responseId' => 2,
          'optionGroupId' => 1,
          'optionId'    => 2
          );

        DB::table('option_response')->insert($option);
        
        /**
		*  Do you snuff?
        */
        Response::create([
            'id'            => 3,
            'screeningId'   => 1,
            'queryId'	    => 3
        ]);

        $option = array(
          'responseId' => 3,
          'optionGroupId' => 1,
          'optionId'    => 2
          );

        DB::table('option_response')->insert($option);

 		/**
		*  Do you take alcohol
        */
        Response::create([
            'id'            => 4,
            'screeningId'   => 1,
            'queryId'	    => 4
        ]);
        $option = array(
          'responseId' => 4,
          'optionGroupId' => 1,
          'optionId'    => 3
          );

        DB::table('option_response')->insert($option);


 		//Children of question 1
		/**
		* What was your age when you started this habit?
		*/
 		Response::create([
            'id'            => 5,
            'screeningId'   => 1,
            'queryId'	    => 5,	
            'numberAnswer'	=> 18,	
        ]);
 		/**
 		* Mention quantity in a day?
 		*/
		
		Response::create([
            'id'            => 6,
            'screeningId'   => 1,
            'queryId'	    => 6,	
            'numberAnswer'	=> 3,	
        ]);
        /**
        * What is(was) the duration of this habit in years?
        */

        Response::create([
            'id'            => 7,
            'screeningId'   => 1,
            'queryId'	    => 7,	
            'numberAnswer'	=> 4,	
        ]);

        //Children of question 2 : Do you chew? 
        // No children as answer is no
        //Children of question 3: Do you snuff?
        // No children as answer is no

		 //Children of question 3: Do you take alcohol

    /**
		* What was your age when you started this habit?
		*/
 		Response::create([
            'id'            => 8,
            'screeningId'   => 1,
            'queryId'	    => 14,	
            'numberAnswer'	=> 18,	
        ]);
 		/**
 		* Mention quantity in a day?
 		*/
		
		Response::create([
            'id'            => 9,
            'screeningId'   => 1,
            'queryId'	    => 15,	
            'numberAnswer'	=> 0.25,	
        ]);
        /**
        * What is(was) the duration of this habit in years?
        */

        Response::create([
            'id'            => 10,
            'screeningId'   => 1,
            'queryId'       => 16,  
            'numberAnswer'  => 3,   
        ]);
        /**
        *  What is your food preference?
        */

        Response::create([
            'id'            => 11,
            'screeningId'   => 1,
            'queryId'       => 17  
        ]);

        $option = array(
          'responseId' => 11,
          'optionGroupId' => 2,
          'optionId'    => 2
          );

        DB::table('option_response')->insert($option);

        /**
        *  Choose non veg foods you consume?
        */
        Response::create([
            'id'            => 12,
            'screeningId'   => 1,
            'queryId'       => 18   
        ]);
        
          $option = array(
            'responseId' => 12,
            'optionGroupId' => 3,
            'optionId'    => 6
          );
          $options[] = $option;

          $option = array(
            'responseId' => 13,
            'optionGroupId' => 3,
            'optionId'    => 7
          );
          $options[] = $option;
          $option = array(
            'responseId' => 14,
            'optionGroupId' => 3,
            'optionId'    => 8
          );
          $options[] = $option;
          $option = array(
            'responseId' => 15,
            'optionGroupId' => 3,
            'optionId'    => 9
          );
          $options[] = $option;
        DB::table('option_response')->insert($options);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints

    }
}
