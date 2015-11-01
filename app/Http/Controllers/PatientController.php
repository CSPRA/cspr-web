<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


use App\Patient;

use DB;

use Input;
use Storage;
use File;
use App\DiagnosisImage;

class PatientController extends Controller
{

    public function __construct()
    {
       // $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

            $patient = new Patient();
            $patient['name'] = $request->input('name');
            $patient['dob'] =  $request->input('dob');
            $patient['gender'] = $request->input('gender');
            $patient['maritalStatus'] = $request->input('maritalStatus');
            $patient['address'] = $request->input('address');
            $patient['homePhoneNumber'] = $request->input('homePhoneNumber');
            $patient['mobileNumber'] = $request->input('mobileNumber');
            $patient['email'] = $request->input('email');
            $patient['annualIncome'] = $request->input('annualIncome');
            $patient['occupation'] = $request->input('occupation');
            $patient['education'] = $request->input('education');
            $patient['religion'] = $request->input('religion');
            $patient['aliveChildrenCount'] = $request->input('aliveChildrenCount');
            $patient['deceasedChildrenCount'] = $request->input('deceasedChildrenCount');

            $patient['voterId'] = $request->input('voterId');
            $patient['adharId'] = $request->input('adharId');

            $missingParameters = array();

            if ($patient['name'] == null) {
                $missingParameters[] = 'name';
            }
            if ($patient['dob'] == null) {
                $missingParameters[] = 'dob';
            }
            if ($patient['gender'] == null) {
                $missingParameters[] = 'gender';
            }
            if ($patient['maritalStatus'] == null) {
                $missingParameters[] = 'maritalStatus';
            }
            if ($patient['address'] == null) {
                $missingParameters[] = 'address';
            }
            if ($patient['mobileNumber'] == null) {
                $missingParameters[] = 'mobileNumber';
            }
            if ($patient['annualIncome'] == null) {
                $missingParameters[] = 'annualIncome';
            }
            if ($patient['occupation'] == null) {
                $missingParameters[] = 'occupation';
            }
            if ($patient['education'] == null) {
                $missingParameters[] = 'education';
            }
            if ($patient['religion'] == null) {
                $missingParameters[] = 'religion';
            }
            if ($patient['aliveChildrenCount'] == null) {
                $missingParameters[] = 'aliveChildrenCount';
            }
            if ($patient['deceasedChildrenCount'] == null) {
                $missingParameters[] = 'deceasedChildrenCount';
            }
            if ($request->input('eventId') == null) {
                $missingParameters[] = 'eventId';
            }


            if (count($missingParameters) > 0) {
                $missing = '';
                foreach ($missingParameters as $parameters) {
                    $missing .= ' '.$parameters;
                }
                return response()->json([
                   'error' => [
                    'message' => 'Missing parameters:'.$missing,
                    'code' => 400]]);
            }
        DB::beginTransaction();

        try {
            $patient->save();

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                   'error' => [
                    'message' => 'Error while saving Patient',
                    'code' => 400]]);
        }

        try {

            $patientHistory['patientId'] = $patient->id;
            $patientHistory['eventId'] = $request->input('eventId');
            $patientHistory['registeredBy'] = $request->input('registeredBy');
            $patientHistory['diagnosis_status'] = 'Pending';
            DB::table('patient_history')->insert($patientHistory);        
            
            } catch(\Exception $e) {
                DB::rollback();
                return response()->json([
                   'error' => [
                    'message' => 'Error while saving Patient',
                    'code' => 400]]);
            }

        DB::commit();

        return $this->show($patient->id);
    }

    // public function 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = DB::table('patients')
                    ->join('patient_history','patient_history.patientId','=','patients.id')
                    ->join('users','patient_history.registeredBy','=','users.id')
                    ->join('events','events.id','=','patient_history.eventId')
                    ->select('patients.*','patient_history.diagnosis_status','users.id as userId','users.name as userName','events.id as eventId','events.name as eventName')
                    ->where('patients.id','=',$id)
                    ->first();

         $personalDetails['name'] = $patient['name'];
         $personalDetails['dob']= $patient['dob'];
         $personalDetails['gender']= $patient['gender'];
         $personalDetails['maritalStatus'] = $patient['maritalStatus'];
         $personalDetails['address'] = $patient['address'];
         $personalDetails['homePhoneNumber'] = $patient['homePhoneNumber'];
         $personalDetails['mobileNumber'] = $patient['mobileNumber'];
         $personalDetails['email'] = $patient['email'];
         $personalDetails['annualIncome'] = $patient['annualIncome'];
         $personalDetails['occupation'] = $patient['occupation'];
         $personalDetails['education'] = $patient['education'];
         $personalDetails['religion'] = $patient['religion'];
         $personalDetails['aliveChildrenCount'] = $patient['aliveChildrenCount'];
         $personalDetails['deceasedChildrenCount'] = $patient['deceasedChildrenCount'];
         $personalDetails['voterId'] = $patient['voterId'];
         $personalDetails['adharId'] = $patient['adharId'];

         $eventDetails['id'] = $patient['eventId'];
         $eventDetails['name'] = $patient['eventName'];
         $finalResult['id'] = $patient['id'];
        $finalResult['personalDetails'] = $personalDetails;
        $finalResult['event'] = $eventDetails;
        $finalResult['diagnosis_status'] = $patient['diagnosis_status'];
        $finalResult['registeredBy'] = array('id'=>$patient['userId'],'name'=>$patient['userName']);
        return  response()->json(['result'=>$finalResult]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * This method returns different results based on user role
     * For volunteer: This is will return 
     */
    
    public function fetchPatients(Request $request) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
