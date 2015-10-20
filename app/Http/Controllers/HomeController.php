<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends TokenAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function create()
    {
        return view('authorization.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    
    public function store(Request $request) {
        $request['role'] = 'admin';
        return $this->register($request);
    }

    public function login(Request $request)
    {
        $request['role'] = 'admin';
        $result = $this->authenticate($request);
        $value = $result->getData();
        if (property_exists($value,'error')) {
            return $result;
        }else {
            $loggedUser['id'] = $value->result->id;
            $loggedUser['username'] = $value->result->name;
            $loggedUser['email'] = $value->result->email;
            $loggedUser['role'] = $value->result->role;
            $loggedUser['token'] = $value->result->token;
            return response()->json(['result'=>$loggedUser]);
        }
    }

    public function dashboard() {
        return view('home.dashboard');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
