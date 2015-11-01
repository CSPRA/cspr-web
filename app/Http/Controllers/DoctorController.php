<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Controllers\Controller;

use App\Doctor;
use App\Appointment;
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
            return $this->fetchDoctor($value->result->id);
        }
   }

    public function fetchDoctors(Request $request) {
        $specialization = $request['specialization'];
        $location = $request['location'];
        $query = DB::table('doctors')
                ->join('cancer_types', 'doctors.specialization', '=', 'cancer_types.id')
                ->join('users','doctors.userId','=','users.id')
                ->leftjoin('ratings','ratings.givenTo','=','doctors.userId')
                ->select('doctors.*','users.email','cancer_types.name as cancerName','ratings.ratingValue');
        if ($specialization) {
            $query = $query->where('doctors.specialization','=',$specialization);
        }
        if ($location) {
            $query = $query->where('doctors.location','=',$location);
        }

        $results = $query->get();
        
        return  response()->json(['result'=>$this->processedDoctor($results)]);           
    }

    private function processedDoctor($results) {
        $doctorsList = array();
        $doctorIds = array_unique((array_column($results, 'userId')));

        foreach ($doctorIds as $id) {
            $doctor['id'] = $id;
            $recordsForId = array_filter($results, function($v) use($id){
             return $v['userId'] == $id; 
            });

            $ratingValues = array_column($recordsForId,'ratingValue');
            $sum = 0;
            foreach ($ratingValues as $ratingValue) {
                $sum += $ratingValue;
            }
            if (count($ratingValues) > 0) {
                $doctor['rating'] = $sum/count($ratingValues);
            }
            $doctorInfo = reset($recordsForId);
            $doctor['firstname'] = $doctorInfo['firstname'];
            $doctor['lastname'] = $doctorInfo['lastname'];
            $doctor['contactNumber'] = $doctorInfo['contactNumber'];
            $doctor['email'] = $doctorInfo['email'];
            $doctor['location'] = $doctorInfo['location'];
            $doctor['specialization'] = $doctorInfo['cancerName'];
            $doctorsList[] = $doctor;
        }
        return $doctorsList;
    }
    public function fetchDoctor($doctorId) {
         try {
            $results = DB::table('doctors')
                    ->join('cancer_types', 'doctors.specialization', '=', 'cancer_types.id')
                    ->join('users','doctors.userId','=','users.id')
                    ->leftjoin('ratings','ratings.givenTo','=','doctors.userId')
                    ->select('doctors.*','users.email','cancer_types.name as cancerName','ratings.ratingValue')
                    ->where('doctors.userId','=',$doctorId)
                    ->get();
            $doctors = $this->processedDoctor($results);
        }catch(\Exception $e) {
            return response()->json([
                    'error' => [
                        'message' => 'User not authorized',
                        'code' => 400,
                        ]
                     ], HttpResponse::HTTP_CONFLICT);
        }
        return  response()->json(['result'=>reset($doctors)]);           
    }

    public function createAppointment(Request $request) {
        $value = $this->getAuthenticatedUser()->getData();
        try {
            $appointment = Appointment::create([
            'doctorId'        => $request->input('doctorId'),
            'screeningId'     => $request->input('screeningId'),
            'requestedBy'     => $value->result->id,
            'status'          => 'pending'
            ]); 
        }catch(\Exception $e) {
            return response()->json([
                    'error' => [
                        'message' => 'Could not assign doctor',
                        'code' => 400,
                        ]
                     ], HttpResponse::HTTP_CONFLICT);
        }
        return response()->json(['result'=> $appointment]); 
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
