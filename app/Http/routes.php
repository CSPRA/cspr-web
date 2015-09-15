<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
$api = app('api.router');

$api->version('v1', function ($api) {
    $api->get('volunteer/{id}', 'App\Http\ControllersVolunteerController@show');
});

Route::get('/', 
  ['as' => 'home', 'uses' => 'HomeController@create']
);
Route::post('login', 
  ['as' => 'login', 'uses' => 'HomeController@store']
);
Route::get('dashboard', 
  ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']
);
