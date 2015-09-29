<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Patient;

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
        $patient['registeredBy'] = $request->input('registeredBy');

        
         $patient->save();
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $patient;
    }

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
