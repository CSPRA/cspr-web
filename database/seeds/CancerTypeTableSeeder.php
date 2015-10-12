<?php

use Illuminate\Database\Seeder;
use App\CancerType;

class CancerTypeTableSeeder extends Seeder
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

        DB::table('cancer_types')->truncate();
        
        CancerType::create([
            'id'            => 1,
            'name'          => 'Throat Cancer',
            'description'   => 'Throat cancer refers to cancerous tumors that develop in your throat (pharynx), voice box (larynx) or tonsils.'
        ]);

        CancerType::create([
            'id'            => 2,
            'name'          => 'Skin Cancer',
            'description'   => 'Skin Cancer is a type of disease where malignant cancer cells are to be found in the outer layer of skin of a person.'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
