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
Route::post('adminLogin', 
  ['as' => 'adminLogin', 'uses' => 'HomeController@login']
);

Route::post('adminRegister',
   ['as' => 'adminRegister', 'uses' => 'HomeController@store']
);
Route::get('dashboard', 
  ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']
);

Route::post('volunteer/register',
  ['as' => 'register','uses' => 'VolunteerController@store']
);

Route::post('volunteer/login',
  ['as' => 'login','uses' => 'VolunteerController@login']
);

Route::get('volunteers',
  ['as' => 'volunteers','uses' => 'VolunteerController@index']
);

Route::post('doctor/register',
  ['as' => 'register','uses' => 'DoctorController@store']
);

Route::post('doctor/login',
  ['as' => 'login','uses' => 'DoctorController@login']
);

Route::post('staff/register',
  ['as' => 'register','uses' => 'StaffController@store']
);

Route::post('staff/login',
  ['as' => 'login','uses' => 'StaffController@login']
);

Route::post('register_patient',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'register_patient', 
   'uses' => 'PatientController@create',
   'roles' => ['admin', 'staff', 'volunteer']
   ]
);

Route::post('create_cancer_type',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'create_cancer_type',
  'uses' =>'QuestionController@createCancerType',
  'roles' => ['admin','staff']
  ]
);

Route::get('cancerTypes',
  ['as' => 'cancerTypes', 'uses'=>'QuestionController@getCancerTypes']
  );
