<?php

use Illuminate\Database\Seeder;
use App\Patient;

class PatientTableSeeder extends Seeder
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

        DB::table('patients')->truncate();
 
        Patient::create([
            'id'            => 1,
            'name'          => 'S. Sudarshan',
            'dob'       	=> '1980-12-01',
            'gender'		=> 'male',
            'maritalStatus' => 'married',
    		'address'       => 'lorem ipsum',
    		'homePhoneNumber'	=> null,
    		'mobileNumber'  => '981890899',
    		'email' 		=> null,
    		'annualIncome'  => 300000,
    		'occupation'    => 'bussiness',
    		'education'     => 'College',
    		'religion'		=> 'Hindu',
        	'voterId'       => 'qw12340',
        	'adharId'		=> null,
        	'aliveChildrenCount' => 2,
        	'deceasedChildrenCount'=> 0
        ]);

        $patientHistory['patientId'] = 1;
        $patientHistory['eventId'] = 2;
        $patientHistory['registeredBy'] = 2;
        $patientHistory['diagnosis_status'] = 'Pending';
        
        DB::table('patient_history')->insert($patientHistory);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
