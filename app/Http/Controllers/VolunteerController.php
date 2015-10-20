<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Controllers\Controller;

use App\Volunteer;

use DB;

class VolunteerController extends TokenAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $volunteers = Volunteer::all();
        return $volunteers;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        $request['role'] = 'volunteer';
        $result = $this->register($request);
        $value = $result->getData();

        if (property_exists($value,'error')) {
            return $result;
        }else {
            $volunteer = new Volunteer;
            $volunteer['userId'] = $value->result->id;
            $volunteer['contactNumber'] = $request->input('contactNumber');
            $volunteer['firstname'] = $request->input('firstname');
            $volunteer['lastname'] = $request->input('lastname');
            try {
                $volunteer->save();
            }catch(\Exception $e) {
            
                DB::rollback();
            
                return response()->json([
                   'error' => [
                    'message' => 'Error while saving Volunteer',
                    'code' => 400]]);
            }
            
            DB::commit();
            
            $finalResult['id'] = $value->result->id;
            $finalResult['token'] = $value->result->token;
            return  response()->json(['result'=>$finalResult]);
        }
    }

    public function login(Request $request) {
        $request['role'] = 'volunteer';
        $result = $this->authenticate($request);
        $value = $result->getData();
        if (property_exists($value, 'error')) {
            return $result;
        }else {
            try {
                 $volunteer = DB::table('volunteers')->where('userId', $value->result->id)->first();
                }catch(\Exception $e) {
                    return response()->json([
                    'error' => [
                        'message' => 'User not authorized',
                        'code' => 102,
                        ]
                     ], HttpResponse::HTTP_CONFLICT);
                 }
                 $loggedUser['id'] = $value->result->id;
                 $loggedUser['username'] = $value->result->name;
                 $loggedUser['email'] = $value->result->email;
                 $loggedUser['role'] = $value->result->role;
                 $loggedUser['firstname'] = $volunteer['firstname'];
                 $loggedUser['lastname'] = $volunteer['lastname'];
                 $loggedUser['contactNumber'] = $volunteer['contactNumber'];
                 $loggedUser['isVerified'] = $volunteer['isVerified'];
                 $loggedUser['token'] = $value->result->token;
                 return response()->json(['result'=>$loggedUser]);
        }
   }

   public function fetchVolunteerEvents() {
     $value = $this->getAuthenticatedUser()->getData();
     $events = DB::table('event_assignments')
                ->join('events', 'events.id', '=', 'event_assignments.eventId')
                ->join('cancer_types','events.cancerId','=', 'cancer_types.id')
                ->leftjoin('detection_form','events.formId','=','events.formId')
                ->select('events.id','events.name as eventName',
                        'events.eventType',
                        'event_assignments.startingDate','event_assignments.endingDate',
                        'events.formId','detection_form.name as formName',
                        'detection_form.description as formDescription',
                        'cancer_types.id as cancerId',
                        'cancer_types.name as cancerName',
                        'cancer_types.description as cancerDescription')
                ->where('volunteerId','=',$value->user->id)
                ->get();

    $finalResult = array();
    foreach ($events as $event) {
        $object['eventId'] = $event['id'];
        $object['eventName'] = $event['eventName'];
        $object['eventType'] = $event['eventType'];
        $object['startingDate'] = $event['startingDate'];
        $object['endingDate'] = $event['endingDate'];

        if (isset($event['formId'])){
            $object['form'] = array('formId'=> $event['formId'],
                                  'formName'=> $event['formName'],
                          'formDescription' => $event['formDescription']);
        }else {
            $object['form'] = array();
        }
        $object['cancerType'] = array('cancerId'=>$event['cancerId'],
                                      'cancerName'=> $event['cancerName'],
                                      'description'=> $event['cancerDescription']);
        $finalResult[] = $object;
    }
    return response()->json(['results'=>$finalResult]);
   }

   public function fetchPatients($eventId) {
      $value = $this->getAuthenticatedUser()->getData();
      $patients = DB::table('screenings')
                  ->join('patients','patients.id','=','screenings.patientId')
                  ->select('patients.*','screenings.id as screeningId')
                  ->where('eventId','=',$eventId)
                  ->where('volunteerId','=',$value->user->id)
                  ->get();
       $finalResult = array();
       foreach ($patients as $patient) {
       
         $object['id'] = $patient['id'];
         $object['name'] = $patient['name'];
         $object['dob'] = $patient['dob'];
         $object['gender'] = $patient['gender'];
          $object['maritalStatus'] = $patient['maritalStatus'];
          $object['email'] = $patient['email'];
          $object['annualIncome'] = $patient['annualIncome'];
          $object['occupation'] = $patient['occupation'];
          $object['education'] = $patient['education'];
          $object['religion'] = $patient['religion'];

          $object['aliveChildrenCount'] = $patient['aliveChildrenCount'];
          $object['deceasedChildrenCount'] = $patient['deceasedChildrenCount'];
          $object['voterId'] = $patient['voterId'];
          $object['adharId'] = $patient['adharId'];
          $finalResult[] = array('screeningId'=>$patient['screeningId'],'patient' => $object);
       }
    return response()->json(['results'=>$finalResult]);
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
