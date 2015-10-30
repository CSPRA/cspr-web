<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Volunteer;
use App\Doctor;

class AdminController extends TokenAuthController
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

    public function approveVolunteer($volunteerId) {
        try{
            Volunteer::where('userId', $volunteerId)
                      ->update(['isVerified' => true]);
            }catch(\Exception $e) {
             return array('error' => [
                    'message' => 'Error in updating object',
                    'code' => 101,
                    ]);
        }
        return response()->json(['result' =>'success']);
    }

    public function approveDoctor($doctorId) {
        try{
            Doctor::where('userId', $doctorId)
                      ->update(['isVerified' => true]);
        }catch(\Exception $e) {
            return array('error' => [
                    'message' => 'Error in updating object',
                    'code' => 101,
                    ]);
        }
        return response()->json(['result' =>'success']);

    }

    public function fetchStatistics(Request $requests){
        $startDate = $request['startDate'];
        $endDate = $request['endDate']; 

        //Fetch registration
        //Fetch Screening
        //Fetch Events
        //Fetch Visits

        $registrationCount = DB::table('patient_history')
                ->where('created_at','>',$startDate)
                ->where('created_at','<',$endDate)
                ->count();

        $screeningCount = DB::table('screenings')
                ->where('created_at','>',$startDate)
                ->where('created_at','<',$endDate)
                ->count();

        $eventCount = DB::table('events')
                ->where('created_at','>',$startDate)
                ->where('created_at','<',$endDate)
                ->count();

        $result['regisrations'] = $registrationCount;
        $result['screenings'] = $screeningCount;
        $result['events'] = $eventCount;
        
        return response()->json(['result' =>$result]);
    }

}
