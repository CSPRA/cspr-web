<?php

use Illuminate\Database\Seeder;
use App\Query;

class QueryTableSeeder extends Seeder
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
        DB::table('query')->truncate();

        /**
		*  Do you smoke?
        */

        Query::create([
            'id'            => 1,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 1,
            'questionType'  => 'single choice',
            'optionGroupId'	=> 1,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 1
        ]);

        /**
		*  Do you chew?
        */

        Query::create([
            'id'            => 2,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 2,
            'questionType'  => 'single choice',
            'optionGroupId'	=> 1,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 2
        ]);

        /**
		*  Do you snuff?
        */

        Query::create([
            'id'            => 3,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 3,
            'questionType'  => 'single choice',
            'optionGroupId'	=> 1,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 3
        ]);

        /**
		*  Do you take alcohol
        */

        Query::create([
            'id'            => 4,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 4,
            'questionType'  => 'single choice',
            'optionGroupId'	=> 1,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 4
        ]);

        //Children of question 1

		Query::create([
            'id'            => 5,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 10,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'years',
            'parentQueryId' => 1,
            'order'			=> 1
        ]);

        Query::create([
            'id'            => 6,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 11,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'pieces',
            'parentQueryId' => 1,
            'order'			=> 2
        ]);

        Query::create([
            'id'            => 7,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 12,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'years',
            'parentQueryId' => 1,
            'order'			=> 3
        ]);
        //Children of question 2

        Query::create([
            'id'            => 8,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 10,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'years',
            'parentQueryId' => 2,
            'order'			=> 1
        ]);

        Query::create([
            'id'            => 9,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 11,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'pieces',
            'parentQueryId' => 2,
            'order'			=> 2
        ]);
        Query::create([
            'id'            => 10,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 12,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'years',
            'parentQueryId' => 2,
            'order'			=> 3
        ]);
        //Children of question 3

        Query::create([
            'id'            => 11,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 10,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'years',
            'parentQueryId' => 3,
            'order'			=> 1
        ]);

        Query::create([
            'id'            => 12,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 11,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'pieces',
            'parentQueryId' => 3,
            'order'			=> 2
        ]);
        Query::create([
            'id'            => 13,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 12,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'years',
            'parentQueryId' => 3,
            'order'			=> 3
        ]);

        //Children of question 4
    
        Query::create([
            'id'            => 14,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 10,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'years',
            'parentQueryId' => 4,
            'order'			=> 1
        ]);

        Query::create([
            'id'            => 15,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 11,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'pieces',
            'parentQueryId' => 4,
            'order'			=> 2
        ]);
        Query::create([
            'id'            => 16,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 12,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> 'years',
            'parentQueryId' => 4,
            'order'			=> 3
        ]);
		/**
		*  What is your food preference?
        */
         Query::create([
            'id'            => 17,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 5,
            'questionType'  => 'single choice',
            'optionGroupId'	=> 2,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 5
        ]);

        /**
		*  Choose non veg foods you consume?
        */
        Query::create([
            'id'            => 18,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 6,
            'questionType'  => 'multiple choice',
            'optionGroupId'	=> 3,
            'units'			=> null,
            'parentQueryId' => 17,
            'order'			=> 1
        ]);
        /**
		*  Do you eat spicy/oily food regularly?
        */
        Query::create([
            'id'            => 19,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 7,
            'questionType'  => 'boolean',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 6
        ]);

        /**
		*  Do you consume junk food regularly?
        */
        Query::create([
            'id'            => 20,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 8,
            'questionType'  => 'boolean',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 7
        ]);
        /**
        * Choose junk foods you generally consume?
        */
        Query::create([
            'id'            => 21,
            'formId'		=> 1,
            'sectionId'     => 1,
            'questionId'	=> 9,
            'questionType'  => 'multiple choice',
            'optionGroupId'	=> 4,
            'units'			=> null,
            'parentQueryId' => 20,
            'order'			=> 1
        ]);

        /**
        * Choose chronics diseases present in family?
        */
        Query::create([
            'id'            => 22,
            'formId'		=> 1,
            'sectionId'     => 2,
            'questionId'	=> 49,
            'questionType'  => 'multiple choice',
            'optionGroupId'	=> 5,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 1
        ]);


        /**
        * Is there any change in bowel or bladder habits
        */
        Query::create([
            'id'            => 23,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 13,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 2
        ]);

        /**
        * Is there any ulcer or swelling anywhere (including breasts)?
        */
        Query::create([
            'id'            => 24,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 18,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 3
        ]);
        
        /**
        * Have you noticed any unusual bleeding?
        */
        Query::create([
            'id'            => 25,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 14,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 4
        ]);

        /**
        * Have you experienced any indigestion / loss of appetite / loss of weight?'
        */
        Query::create([
            'id'            => 26,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 15,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 5
        ]);

        /**
        * Have you noticed any change in your birth marks or warts?
        */
        Query::create([
            'id'            => 27,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 16,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 6
        ]);

        /**
        * Are you experiencing any chronic cough / hoarsness / difficulty in swallowing?
        */
        Query::create([
            'id'            => 28,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 17,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 7
        ]);

        /**
        * Is there any white patch in your mouth?
        */
        Query::create([
            'id'            => 29,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 19,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 8
        ]);

        /**
        * Any excess urination / excess thirst / excess hunger / giddiness
        */
        Query::create([
            'id'            => 30,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 20,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 9
        ]);

        /**
        * Any other symptoms
        */
           Query::create([
            'id'            => 31,
            'formId'		=> 1,
            'sectionId'     => 3,
            'questionId'	=> 21,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 10
        ]);
        /**
        * Medical Reports
        */
        Query::create([
            'id'            => 32,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 50,
            'questionType'  => 'boolean',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 1
        ]);

        /**
        * CVS
        */
        Query::create([
            'id'            => 33,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 51,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 32,
            'order'			=> 1
        ]);
        /**
        * BP
        */
        Query::create([
            'id'            => 34,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 52,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 32,
            'order'			=> 2
        ]);
        /**
        * Pulse
        */
        Query::create([
            'id'            => 35,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 53,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 32,
            'order'			=> 3
        ]);

        /**
        * RS
        */
        Query::create([
            'id'            => 36,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 54,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 32,
            'order'			=> 4
        ]);

        /**
        * Liver
        */
        Query::create([
            'id'            => 37,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 55,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 32,
            'order'			=> 5
        ]);

       	/**
        * Spleen
        */
        Query::create([
            'id'            => 38,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 56,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 32,
            'order'			=> 6
        ]);

        /**
        * Lymphnodes
        */
        Query::create([
            'id'            => 39,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 57,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 32,
            'order'			=> 7
        ]);

        /**
        * Surgical Reports
        */
        Query::create([
            'id'            => 40,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 58,
            'questionType'  => 'boolean',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 2
        ]);
        /**
        * Breasts
        */
        Query::create([
            'id'            => 41,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 59,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 1
        ]);
        /**
        * Thyroid
        */
        Query::create([
            'id'            => 42,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 60,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 2
        ]);
        /**
        * Bones & Skin
        */
        Query::create([
            'id'            => 43,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 61,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 3
        ]);
        /**
        * Tetses
        */
        Query::create([
            'id'            => 44,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 62,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 4
        ]);
        /**
        * PR
        */
        Query::create([
            'id'            => 45,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 63,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 5
        ]);
        /**
        * PA
        */
        Query::create([
            'id'            => 46,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 64,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 6
        ]);
        /**
        * Head or Neck
        */
        Query::create([
            'id'            => 47,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 65,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 7
        ]);
		/**
        * Pharynx
        */
        Query::create([
            'id'            => 48,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 66,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 8
        ]);
		/**
        * Larynx
        */
        Query::create([
            'id'            => 49,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 67,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 9
        ]);
		/**
        * Post 1/3 Tongue
        */
        Query::create([
            'id'            => 50,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 68,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 10
        ]);
		/**
        * Oral & Dental
        */
        Query::create([
            'id'            => 51,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 69,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 11
        ]);
		/**
        * Lukoplakia
        */
        Query::create([
            'id'            => 52,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 70,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 40,
            'order'			=> 12
        ]);
		/**
        * Is Gynecology History Applicable?
        */
        Query::create([
            'id'            => 53,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 22,
            'questionType'  => 'boolean',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 3
        ]);
       	/**
        * What was your age when you got married?
        */
        Query::create([
            'id'            => 54,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 23,
            'questionType'  => 'number',
            'optionGroupId'	=> null,
            'units'			=> "years",
            'parentQueryId' => 53,
            'order'			=> 1
        ]);
        /**
        * What was your age Menarche?
        */
        Query::create([
            'id'            => 55,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 24,
            'questionType'  => 'number',
            'optionGroupId'	=> null,
            'units'			=> "years",
            'parentQueryId' => 53,
            'order'			=> 2
        ]);
        /**
        * What was your age at first delivery?
        */
        Query::create([
            'id'            => 56,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 25,
            'questionType'  => 'number',
            'optionGroupId'	=> null,
            'units'			=> "years",
            'parentQueryId' => 53,
            'order'			=> 3
        ]);
        /**
        * What was your age at last delivery?
        */
        Query::create([
            'id'            => 57,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 26,
            'questionType'  => 'number',
            'optionGroupId'	=> null,
            'units'			=> "years",
            'parentQueryId' => 53,
            'order'			=> 4
        ]);
        /**
        * What was your age of Menopause?
        */
        Query::create([
            'id'            => 58,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 27,
            'questionType'  => 'number',
            'optionGroupId'	=> null,
            'units'			=> "years",
            'parentQueryId' => 53,
            'order'			=> 5
        ]);
        /**
        * Is Obstetric History Applicable?
        */
        Query::create([
            'id'            => 59,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 28,
            'questionType'  => 'boolean',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 4
        ]);
        /**
        * What is the number of pregnacies?
        */
        Query::create([
            'id'            => 60,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 29,
            'questionType'  => 'number',
            'optionGroupId'	=> null,
            'units'			=> "nos",
            'parentQueryId' => 59,
            'order'			=> 1
        ]);
        /**
        * What is the number of abortions?
        */
        Query::create([
            'id'            => 61,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 30,
            'questionType'  => 'number',
            'optionGroupId'	=> null,
            'units'			=> "nos",
            'parentQueryId' => 59,
            'order'			=> 2
        ]);

        /**
        * What is the number of living children?
        */
        Query::create([
            'id'            => 62,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 31,
            'questionType'  => 'number',
            'optionGroupId'	=> null,
            'units'			=> "nos",
            'parentQueryId' => 59,
            'order'			=> 3
        ]);
        /**
        * Are you pregnant currently?
        */
        Query::create([
            'id'            => 63,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 32,
            'questionType'  => 'boolean',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 59,
            'order'			=> 4
        ]);
        /**
        * What is your feeding method?
        */
        Query::create([
            'id'            => 64,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 33,
            'questionType'  => 'multiple choice',
            'optionGroupId'	=> 9,
            'units'			=> null,
            'parentQueryId' => 59,
            'order'			=> 5
        ]);

        /**
        * Is Menstural History Applicable?
        */
        Query::create([
            'id'            => 65,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 34,
            'questionType'  => 'boolean',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 5
        ]);

        /**
        * Select applicable issues related menstural health
        */
        Query::create([
            'id'            => 66,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 35,
            'questionType'  => 'multiple choice',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 65,
            'order'			=> 1
        ]);
        /**
        * What are your methods of family planning?
        */
        Query::create([
            'id'            => 67,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 36,
            'questionType'  => 'multiple choice',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 6
        ]);

        /**
        * Specify other methods of family planning?
        */
        Query::create([
            'id'            => 68,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 37,
            'questionType'  => 'text',
            'optionGroupId'	=> null,
            'units'			=> null,
            'parentQueryId' => 67,
            'order'			=> 1
        ]);
        /**
        * Specify necessary investigations to be done
        */
        Query::create([
            'id'            => 69,
            'formId'		=> 1,
            'sectionId'     => 4,
            'questionId'	=> 47,
            'questionType'  => 'multiple choice',
            'optionGroupId'	=> 8,
            'units'			=> null,
            'parentQueryId' => null,
            'order'			=> 7
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
