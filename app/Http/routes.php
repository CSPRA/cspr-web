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

Route::post('create_section',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'create_section',
  'uses' =>'QuestionController@createSection',
  'roles' => ['admin','staff']
  ]
);

Route::get('sections',
  ['as' => 'sections', 'uses'=>'QuestionController@getSections']
  );

Route::post('add_question',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'add_question',
  'uses' =>'QuestionController@addQuestion',
  'roles' => ['admin','staff']
  ]
);

Route::get('questions/{sectionId?}/{keywords?}',
  ['as' => 'questions', 'uses'=>'QuestionController@getQuestions']
);

Route::post('add_optionGroup',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'add_optionGroup',
  'uses' =>'QuestionController@addOptionGroup',
  'roles' => ['admin','staff']
  ]
);

Route::get('optionGroups/{sectionId?}',
  ['as' => 'optionGroups', 'uses'=>'QuestionController@getOptionGroups']
);

Route::post('add_options/{groupId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'add_options',
  'uses' =>'QuestionController@addOptions',
  'roles' => ['admin','staff']
  ]
);

Route::get('options/{groupId?}',
  ['as' => 'options', 'uses'=>'QuestionController@getOptions']
);

Route::post('create_detection_form',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'create_detection_form',
  'uses' =>'DiagnosisController@createDetectionForm',
  'roles' => ['admin','staff']
  ]
);

Route::post('add_query/{formId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'add_query',
  'uses' =>'DiagnosisController@addQueryToDetectionForm',
  'roles' => ['admin','staff']
  ]
);

Route::get('queries/{formId?}',
  ['as' => 'queries', 'uses'=>'DiagnosisController@fetchQueryForDetectionForm']
);

Route::post('create_event',
 ['middleware' => ['jwt.auth','roles'],
  'as' =>'create_event',
  'uses' =>'DiagnosisController@createEvent',
  'roles' => ['admin','staff']
  ]);

Route::get('events',
   ['as' => 'events', 'uses'=>'DiagnosisController@fetchEvents']
  );

Route::post('assign_volunteers/{eventId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'assign_volunteers',
  'uses' =>'DiagnosisController@assignVolunteers',
  'roles' => ['admin','staff']]
  );

Route::get('eventVolunteers/{eventId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'eventVolunteers',
  'uses' =>'DiagnosisController@fetchEventVolunteers',
  'roles' => ['admin','staff']]
  );

Route::get('volunteer/myScreeningAssignments',[
  'middleware' => ['jwt.auth','roles'],
  'as' =>'myScreeningAssignments',
  'uses' =>'VolunteerController@fetchVolunteerEvents',
  'roles' => ['volunteer']
  ]);

/******************************/

Route::post('volunteer/registerPatient',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'registerPatient', 
   'uses' => 'PatientController@create',
   'roles' => ['volunteer']
   ]
);

Route::get('volunteer/fetchPatients/{eventId}',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'fetchPatients', 
   'uses' => 'VolunteerController@fetchPatients',
   'roles' => ['volunteer']
  ]
);

Route::post('registerPatient',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'registerPatient', 
   'uses' => 'PatientController@create',
   'roles' => ['admin', 'staff']
   ]
);

Route::post('saveDiagnosisImage/{screeningId}',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'saveDiagnosisImage', 
   'uses' => 'PatientController@saveImage',
   'roles' => ['volunteer','admin','staff']
  ]
);

Route::get('diagnosisImage/{screeningId}/{imageName}', 
  ['as' => 'diagnosisImage',
   'uses'=> 'PatientController@fetchImage'
  ]
  );

Route::get('diagnosisImages/{screeningId}',
  ['as' => 'diagnosisImages',
   'uses' => 'PatientController@fetchImagesForScreening'
  ]
  );