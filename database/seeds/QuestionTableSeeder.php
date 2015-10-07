<?php

use Illuminate\Database\Seeder;

use App\Question;

class QuestionTableSeeder extends Seeder
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
        DB::table('questions')->truncate();

        Question::create([
            'id'            => 1,
            'title'         => 'Do you smoke?',
            'sectionId'     => 1]);
        
        Question::create([
            'id'            => 2,
            'title'          => 'Do you chew tobacco?',
            'sectionId'   => 1]);
        
        Question::create([
            'id'            => 3,
            'title'          => 'Do you snuff?',
            'sectionId'   => 1]);
        
        Question::create([
            'id'            => 4,
            'title'          => 'Do you take alcohol?',
            'sectionId'   => 1]);

        Question::create([
            'id'            => 5,
            'title'          => 'What is your food preference?',
            'sectionId'   => 1]);

         Question::create([
            'id'            => 6,
            'title'          => 'Choose non veg foods you consume?',
            'sectionId'   => 1]);

		Question::create([
            'id'            => 7,
            'title'          => 'Do you eat spicy/oily food regularly?',
            'sectionId'   => 1]);

		Question::create([
            'id'            => 8,
            'title'          => 'Do you consume junk food regularly?',
            'sectionId'   => 1]);

        Question::create([
            'id'            => 9,
            'title'          => 'Choose junk foods you generally consume?',
            'sectionId'   => 1]);

        Question::create([
            'id'            => 10,
            'title'          => 'Choose junk foods you generally consume?',
            'sectionId'   => 1]);  

        Question::create([
            'id'            => 11,
            'title'          => 'What was your age when you started this habit?',
            'sectionId'   => 1]);  

		Question::create([
            'id'            => 12,
            'title'          => 'Mention quantity in a day?',
            'sectionId'   => 1]);  

		Question::create([
            'id'            => 13,
            'title'          => 'What is/was the duration of this habit in years?',
            'sectionId'   => 1]);  


        Question::create([
            'id'            => 14,
            'title'          => 'Is there any change in bowel or bladder habits?',
            'sectionId'   => 3]);

        Question::create([
            'id'            => 15,
            'title'          => 'Have you noticed any unusual bleeding?',
            'sectionId'   => 3]);       
        Question::create([
            'id'            => 16,
            'title'          => 'Have you experienced any indigestion / loss of appetite / loss of weight?',
            'sectionId'   => 3]);       
        Question::create([
            'id'            => 17,
            'title'          => 'Have you noticed any change in your birth marks or warts?',
            'sectionId'   => 3]);       

        Question::create([
            'id'            => 18,
            'title'          => 'Are you experiencing anychronic cough / hoarsness / difficulty in swallowing?',
            'sectionId'   => 3]);       

        Question::create([
            'id'            => 19,
            'title'          => 'Is there any ulcer or swelling anywhere (including breasts)?',
            'sectionId'   => 3]);

        Question::create([
            'id'            => 20,
            'title'          => 'Is there any white patch in your mouth?',
            'sectionId'   => 3]);
    
    	Question::create([
            'id'            => 21,
            'title'          => 'Are you experincing Any excess urination / excess thirst / excess hunger / giddiness?',
            'sectionId'   => 3]);

		Question::create([
            'id'            => 22,
            'title'          => 'Specify any other Symptoms?',
            'sectionId'   => 3]);


		Question::create([
            'id'            => 23,
            'title'          => 'Is Gynecology History Applicable?',
            'sectionId'   => 4]);


		Question::create([
            'id'            => 24,
            'title'          => 'What was your age when you got married?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 25,
            'title'          => 'What was your age Menarche?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 26,
            'title'          => 'What was your age at first delivery?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 27,
            'title'          => 'What was your age at last delivery?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 28,
            'title'          => 'What was your age of Menopause?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 29,
            'title'          => 'Is Obstetric History Applicable?',
            'sectionId'   => 4]);


		Question::create([
            'id'            => 30,
            'title'          => 'What is the number of pregnacies?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 31,
            'title'          => 'What is the number of abortions?',
            'sectionId'   => 4]);


		Question::create([
            'id'            => 32,
            'title'          => 'What is the number of living children?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 33,
            'title'          => 'Are you pregnant currently?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 34,
            'title'          => 'What is your feeding method?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 35,
            'title'          => 'Is Menstural History Applicable?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 36,
            'title'          => 'Select applicable issues related menstural health',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 37,
            'title'          => 'What are your methods of family planning?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 38,
            'title'          => 'Specify other methods of family planning?',
            'sectionId'   => 4]);
	
		Question::create([
            'id'            => 39,
            'title'          => 'Is Gynecological Examination applicable?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 40,
            'title'          => 'Is Gynecological Examination applicable?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 41,
            'title'          => 'How is condition of cervix(PS)?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 42,
            'title'          => 'Is Cervicitis detected(PS)?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 43,
            'title'          => 'Is Ectopy detected(PS)?',
            'sectionId'   => 4]);

		Question::create([
            'id'            => 44,
            'title'          => 'Is there contact bleeding(PS)?',
            'sectionId'   => 4]);

	Question::create([
            'id'            => 45,
            'title'          => 'Is WDPV detected(PS)?',
            'sectionId'   => 4]);

	Question::create([
            'id'            => 46,
            'title'          => 'Specify any sort of growth(PS)',
            'sectionId'   => 4]);

	Question::create([
            'id'            => 47,
            'title'          => 'Specify condition of PV',
            'sectionId'   => 4]);

	Question::create([
            'id'            => 48,
            'title'          => 'Specify condition of PR',
            'sectionId'   => 4]);

	Question::create([
            'id'            => 49,
            'title'          => 'Specify necessary investigations to be done',
            'sectionId'   => 4]);

	Question::create([
            'id'            => 50,
            'title'          => 'What is the result of clinical diagnosis?',
            'sectionId'   => 4]);

	Question::create([
            'id'            => 51,
            'title'          => 'Choose chronics diseases present in family?',
            'sectionId'   => 2]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
