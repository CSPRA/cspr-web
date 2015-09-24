<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Volunteer;

use DB;

class VolunteerController extends Controller
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
        $volunteer = new Volunteer;
        $volunteer->username = $request['username'];
        $volunteer->password = $request['password'];
        $volunteer->firstname = $request['firstname'];
        $volunteer->lastname = $request['lastname'];
        $volunteer->email = $request['email'];
        $volunteer->contactNumber = $request['contactNumber'];

        if ($this->isUsernamePresent($request['username'])){

        }


        //if username already exists?
        //if email already registered
        //throw error
        //else return user
        $error = $volunteer->save();
 
    // return Response::json(array(
    //     'error' => false,
    //     'volunteer' => $volunteer),
    //     200
    // );
        //
		echo json_encode($error);
    }

    public function login() {

    }

    private function isUsernamePresent($username) {
        $volunteer = DB::table('volunteers')->where('username', $username)->first();
        $result = (is_null($volunteer)) ? false : true;
        return $result;
    }

    private function isEmailPresent($email) {
        $volunteer = DB::table('volunteers')->where('email', $email)->first();
        $result = (is_null($volunteer)) ? false : true;
        return $result;

    }


    public function checkAvailabilty($username) {
       echo json_encode($this->isUsernamePresent($username));
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
