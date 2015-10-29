<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

use Illuminate\Support\Facades\Hash;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal;
use Response;
use DB;

class TokenAuthController extends Controller
{
 
 protected $fractal;

public function __construct()
  {
    $this->fractal = new Fractal\Manager();
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

  public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(
                    ['error' => array('message' => 'invalid_credentials',
                                       'code' => 401)]);
            }
        } catch (JWTException $e) {
            return response()->json(
                    ['error' => array('message' => 'could_not_create_token',
                                       'code' => 500)]);
        }

        try {
            $user = DB::table('users')->where('email', $request['email'])->first();
            $role = DB::table('roles')->where('id', $user['roleId'])->pluck('name');
            if ($role!= $request->input('role')) {
                return response()->json(
                    ['error' => array('message' => 'User does not exist for this role',
                                       'code' => 401)]);
            }
        }catch (JWTException $e) {
            return response()->json(
                    ['error' => array('message' => 'could not fetch user',
                                       'code' => 500)]);
        }

        $user['token'] = $token;
        $user['role'] = $role;
        return response()->json(['result' => $user]);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(
                    ['error' => array('message' => 'token_expired',
                                       'code' => $e->getStatusCode())]);

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(
                    ['error' => array('message' => 'token_invalid',
                                       'code' => $e->getStatusCode())]);

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(
                    ['error' => array('message' => 'token_absent',
                                       'code' => $e->getStatusCode())]);
        }
        return response()->json(['user' => $user]); 
    }

    private function isEmailPresent($email) {
        $user = DB::table('users')->where('email', $email)->first();
        $result = (is_null($user)) ? false : true;
        return $result;

    }
    private function isUsernamePresent($username) {
        $user = DB::table('users')->where('name', $username)->first();
        $result = (is_null($user)) ? false : true;
        return $result;
    }

    public function register(Request $request) {

        $newUser['name'] = $request->input('username');
        $newUser['password'] = Hash::make($request->input('password'));
        $newUser['email'] = $request->input('email');
        
        if ($newUser['name'] && $newUser['password'] && $newUser['email']) {

            if ($this->isEmailPresent($request['email']) || $this->isUsernamePresent($request['username'])) {
             return response()->json(
                    ['error' => array('message' => 'User is already registered',
                                       'code' => 400)]);
            }

            $roleId = DB::table('roles')->where('name', $request->input('role'))->pluck('id');

            if ($roleId == null) {
              return response()->json(['error'=>array( 'message' => 'Requested Role Not Present',
                    'code' => 400)]);
             }

            $newUser['roleId'] = $roleId;

            try {
                 $user = User::create($newUser);
            }catch (\Exception $e) {
                return response()->json(['error'=>array( 'message' => 'Could not save user',
                                   'code' => 500)]);
            }
            return response()->json(['result'=> array( 'id' => (int) $user->id,
                                                     'token' => JWTAuth::fromUser($user))]); 

        }else {
             return response()->json(['error' => array('message' => 'Missing Parameters',
                                                         'code' => 400)]);
        }
    }

}
