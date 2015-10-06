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
        $value = json_decode($result,true);

        if (array_key_exists('error', $value)) {
            return $result;
        }else {
            $doctor = new Doctor;
            $doctor['userId'] = $value['data']['id'];
            $doctor['contactNumber'] = $request->input('contactNumber');
            $doctor['firstname'] = $request->input('firstname');
            $doctor['lastname'] = $request->input('lastname');
            try {
                $finalResult = $doctor->save();
            }catch(\Exception $e) {
            
                DB::rollback();
            
                return response()->json([
                'error' => [
                    'message' => $e,
                    'code' => 101,
                    'inputValue' => $doctor
                    ]
                 ], HttpResponse::HTTP_CONFLICT);
            }
            
            DB::commit();
            return $result;
        }
    }

    public function login(Request $request) {
        $result = $this->authenticate($request);
        $value = json_decode($result,true);
        if (array_key_exists('error', $value)) {
            return $result;
        }else {
            try {
                 $doctor = DB::table('doctors')->where('userId', $value['user']['id'])->first();
                }catch(\Exception $e) {
                    return response()->json([
                    'error' => [
                        'message' => 'User not authorized',
                        'code' => 102,
                        ]
                     ], HttpResponse::HTTP_CONFLICT);
                 }
                 $loggedUser['id'] = $value['user']['id'];
                 $loggedUser['username'] = $value['user']['name'];
                 $loggedUser['email'] = $value['user']['email'];
                 $loggedUser['firstname'] = $doctor['firstname'];
                 $loggedUser['lastname'] = $doctor['lastname'];
                 $loggedUser['contactNumber'] = $doctor['contactNumber'];
                 $loggedUser['isVerified'] = $doctor['isVerified'];
                 $loggedUser['token'] = $value['user']['token'];

                 //fetch specialization
                 return json_encode($loggedUser);
        }
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
