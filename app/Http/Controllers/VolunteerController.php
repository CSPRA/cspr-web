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
        $value = json_decode($result,true);

        if (array_key_exists('error', $value)) {
            return $result;
        }else {
            $volunteer = new Volunteer;
            $volunteer['userId'] = $value['data']['id'];
            $volunteer['contactNumber'] = $request->input('contactNumber');
            $volunteer['firstname'] = $request->input('firstname');
            $volunteer['lastname'] = $request->input('lastname');
            try {
                $finalResult = $volunteer->save();
            }catch(\Exception $e) {
            
                DB::rollback();
            
                return response()->json([
                'error' => [
                    'message' => 'Error while saving.',
                    'code' => 101,
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
                 $volunteer = DB::table('volunteers')->where('userId', $value['user']['id'])->first();
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
                 $loggedUser['role'] = $value['user']['role'];
                 $loggedUser['firstname'] = $volunteer['firstname'];
                 $loggedUser['lastname'] = $volunteer['lastname'];
                 $loggedUser['contactNumber'] = $volunteer['contactNumber'];
                 $loggedUser['isVerified'] = $volunteer['isVerified'];
                 $loggedUser['token'] = $value['user']['token'];
                 return json_encode($loggedUser);
        }
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
