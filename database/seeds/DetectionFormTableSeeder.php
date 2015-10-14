<?php

use Illuminate\Database\Seeder;
use App\DetectionForm;

class DetectionFormTableSeeder extends Seeder
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
        DB::table('detection_form')->truncate();

        DetectionForm::create([
            'id'            => 1,
            'name'          => 'Throat Cancer Detection Form',
            'description'   => 'This form contains regarding diagnosis of Throat Cancer',
            'cancerId'   => 1,
            'createdBy'  => 1,
            ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
