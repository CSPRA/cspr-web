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

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', 
  ['as' => 'home', 'uses' => 'HomeController@create']
);
Route::post('login', 
  ['as' => 'login', 'uses' => 'HomeController@store']
);
Route::get('dashboard', 
  ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']
);
Route::post('volunteer/register',
  ['as' => 'register','uses' => 'VolunteerController@store']
);

Route::get('volunteers',
  ['as' => 'volunteers','uses' => 'VolunteerController@index']
);

Route::get('volunteer/checkAvailability/{username}',
  ['as' => 'checkAvailability','uses' => 'VolunteerController@checkAvailabilty']
);
