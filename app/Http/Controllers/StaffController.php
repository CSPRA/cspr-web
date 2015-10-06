<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as HttpResponse;

use App\Staff;

use DB;

class StaffController extends TokenAuthController
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
        $request['role'] = 'staff';
        $result = $this->register($request);
        $value = json_decode($result,true);

        if (array_key_exists('error', $value)) {
            return $result;
        }else {
            $staff = new Staff;
            $staff['userId'] = $value['data']['id'];
            $staff['contactNumber'] = $request->input('contactNumber');
            $staff['firstname'] = $request->input('firstname');
            $staff['lastname'] = $request->input('lastname');
            try {
                $finalResult = $staff->save();
            }catch(\Exception $e) {
            
                DB::rollback();
            
                return response()->json([
                'error' => [
                    'message' => 'Error while saving.'.$e,
                    'code' => 101,
                    ]
                 ], HttpResponse::HTTP_CONFLICT);
            }
            
            DB::commit();
            
            return $result;
        }
    }

    public function login(Request $request) {
        $request['role'] = 'staff';
        $result = $this->authenticate($request);
        $value = json_decode($result,true);
        if (array_key_exists('error', $value)) {
            return $result;
        }else {
            try {
                 $staff = DB::table('staffs')->where('userId', $value['user']['id'])->first();
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
                 $loggedUser['firstname'] = $staff['firstname'];
                 $loggedUser['lastname'] = $staff['lastname'];
                 $loggedUser['contactNumber'] = $staff['contactNumber'];
                 $loggedUser['isVerified'] = $staff['isVerified'];
                 $loggedUser['token'] = $value['user']['token'];

                return json_encode(['user'=>$loggedUser]);

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
