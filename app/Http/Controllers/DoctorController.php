<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Controllers\Controller;

use App\Doctor;
use DB;

class DoctorController extends TokenAuthController
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction(); 
        $request['role'] = 'doctor';

        $result = $this->register($request);
        $value = $result->getData();

        if (property_exists($value, 'error')) {
            return $result;
        }else {
            $doctor = new Doctor;
            $doctor['userId'] = $value->result->id;
            $doctor['contactNumber'] = $request->input('contactNumber');
            $doctor['firstname'] = $request->input('firstname');
            $doctor['lastname'] = $request->input('lastname');
            try {
                $doctor->save();
            }catch(\Exception $e) {
            
                DB::rollback();
                return response()->json([
                   'error' => [
                    'message' => 'Error while saving Doctor',
                    'code' => 400]]);
            }
            
            DB::commit();
            $finalResult['id'] = $value->result->id;
            $finalResult['token'] = $value->result->token;
            return  response()->json(['result'=>$finalResult]);
        }
    }

    public function login(Request $request) {
        $request['role'] = 'doctor';

        $result = $this->authenticate($request);
        $value = $result->getData();
        if (property_exists($value, 'error')) {
            return $result;
        }else {
            try {
                 $doctor = DB::table('doctors')->where('userId', $value->result->id)->first();
                }catch(\Exception $e) {
                    return response()->json([
                    'error' => [
                        'message' => 'User not authorized'.$e,
                        'code' => 400,
                        ]
                     ], HttpResponse::HTTP_CONFLICT);
                 }
                 $loggedUser['id'] = $value->result->id;
                 $loggedUser['username'] = $value->result->name;
                 $loggedUser['email'] = $value->result->email;
                 $loggedUser['firstname'] = $doctor['firstname'];
                 $loggedUser['lastname'] = $doctor['lastname'];
                 $loggedUser['contactNumber'] = $doctor['contactNumber'];
                 $loggedUser['isVerified'] = $doctor['isVerified'];
                 $loggedUser['token'] = $value->result->token;

                 //fetch specialization
                 return  response()->json(['result'=>$loggedUser]);

        }
   }

    public function fetchDoctors(Request $request) {
        $specialization = $request['specialization'];
        $location = $request['location'];
        $query = DB::table('doctors')
                ->join('cancer_types', 'doctors.specialization', '=', 'cancer_types.id')
                ->select('doctors.*','cancer_types.*');
        if ($specialization) {
            $query = $query->where('doctors.specialization','=',$specialization);
        }
        if ($location) {
            $query = $query->where('doctors.location','=',$location);
        }
        $doctors = $query->get();
        return  response()->json(['result'=>$doctors]);           
    }

    public function fetchDoctor($doctorId) {
         $doctor = DB::table('doctors')
                ->join('cancer_types', 'doctors.specialization', '=', 'cancer_types.id')
                ->select('doctors.*','cancer_types.*')
                ->where('doctors.userId','=',$doctorId)
                ->get();
        return  response()->json(['result'=>$doctor]);           

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
