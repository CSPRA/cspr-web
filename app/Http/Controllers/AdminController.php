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

}
