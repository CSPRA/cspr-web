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
                return json_encode(['error' => 'invalid_credentials', 'code'=>401]);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token', 'code'=>500]);
        }

        // if no errors are encountered we can return a JWT
        // return response()->json(compact('token'));
        $user = DB::table('users')->where('email', $request['email'])->first();
        $user['token'] = $token;
         return json_encode(
                [
                    'user' => $user,
                    // compact('token')
                ]);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function register(Request $request) {
        try {
        $newUser['name'] = $request->input('username');
        $newUser['password'] = Hash::make($request->input('password'));
        $newUser['email'] = $request->input('email');
        $newUser['role'] = $request->input('role');
        $user = User::create($newUser);

     } catch (\Exception $e) {
        return json_encode([
                'error' => [
                    'message' => 'User already exists.',
                    'code' => 100
                ]
            ], HttpResponse::HTTP_CONFLICT);
      }
        $resource = new Fractal\Resource\Item($user, function(User $user) {
            return [
                'id'      => (int) $user->id,
                'token'   => JWTAuth::fromUser($user)
            ];
        });

        return $this->fractal->createData($resource)->toJson();
    }
}
