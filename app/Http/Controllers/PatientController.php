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
        DB::beginTransaction();

        try {
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

            $patient->save();

        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }

        try {

            $patientHistory['patientId'] = $patient->id;
            $patientHistory['eventId'] = $request->input('eventId');
            $patientHistory['registeredBy'] = $request->input('registeredBy');
            $patientHistory['diagnosis_status'] = 'Pending';
            DB::table('patient_history')->insert($patientHistory);        
            
            } catch(\Exception $e) {
                DB::rollback();
                return $e->getMessage();
            }

        DB::commit();
        return $patient;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
