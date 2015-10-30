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

Route::post('cancerType',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'create_cancer_type',
  'uses' =>'QuestionController@createCancerType',
  'roles' => ['admin','staff']
  ]
);

Route::get('cancerTypes',
  ['as' => 'cancerTypes', 'uses'=>'QuestionController@getCancerTypes']
  );

// Section
Route::post('section',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'create_section',
  'uses' =>'QuestionController@createSection',
  'roles' => ['admin','staff']
  ]
);

Route::get('sections',
  ['middleware' => ['jwt.auth','roles'],
  'as' => 'sections', 
  'uses'=>'QuestionController@getSections',
  'roles' => ['admin','staff','volunteer','doctor']
  ]);

Route::get('section/{sectionId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' => 'fetch_section', 
  'uses'=>'QuestionController@getSection',
  'roles' => ['admin','staff','volunteer','doctor']
  ]);

// Question
Route::post('addQuestion',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'add_question',
  'uses' =>'QuestionController@addQuestion',
  'roles' => ['admin','staff']
  ]
);

Route::get('questions/{sectionId?}/{keywords?}',
  ['as' => 'questions', 'uses'=>'QuestionController@getQuestions']
);

Route::post('addOptionGroup',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'add_optionGroup',
  'uses' =>'QuestionController@addOptionGroup',
  'roles' => ['admin','staff']
  ]
);

Route::get('optionGroups/{sectionId?}',
  ['as' => 'optionGroups', 'uses'=>'QuestionController@getOptionGroups']
);

Route::post('addOptions/{groupId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'add_options',
  'uses' =>'QuestionController@addOptions',
  'roles' => ['admin','staff']
  ]
);

Route::get('options/{groupId?}',
  ['as' => 'options', 'uses'=>'QuestionController@getOptions']
);

Route::post('createDetectionForm',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'create_detection_form',
  'uses' =>'DiagnosisController@createDetectionForm',
  'roles' => ['admin','staff']
  ]
);

Route::post('addQuery/{formId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'add_query',
  'uses' =>'DiagnosisController@addQueryToDetectionForm',
  'roles' => ['admin','staff']
  ]
);

Route::get('queries/{formId?}',
  ['as' => 'queries', 'uses'=>'DiagnosisController@fetchQueryForDetectionForm']
);

// Event

Route::post('event',
 ['middleware' => ['jwt.auth','roles'],
  'as' =>'create_event',
  'uses' =>'DiagnosisController@createEvent',
  'roles' => ['admin','staff']
  ]);

Route::get('events',
 ['middleware' => ['jwt.auth','roles'],
  'as' =>'fetch_events',
  'uses' =>'DiagnosisController@fetchEvents',
  'roles' => ['admin','staff','volunteer','doctor']
  ]);

Route::get('event/{eventId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'fetch_event',
  'uses' =>'DiagnosisController@fetchEvent',
  'roles' => ['admin','staff','volunteer','doctor']
  ]);

Route::post('assignVolunteers/{eventId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'assign_volunteers',
  'uses' =>'DiagnosisController@assignVolunteers',
  'roles' => ['admin','staff']]
  );

Route::get('eventVolunteers/{eventId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'eventVolunteers',
  'uses' =>'DiagnosisController@fetchEventVolunteers',
  'roles' => ['admin','staff',]]
  );

Route::get('volunteer/myScreeningAssignments',[
  'middleware' => ['jwt.auth','roles'],
  'as' =>'myScreeningAssignments',
  'uses' =>'VolunteerController@fetchVolunteerEvents',
  'roles' => ['volunteer']
  ]);

// Doctor

Route::get('doctors',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'fetch_doctors',
  'uses' =>'DoctorController@fetchDoctors',
  'roles' => ['admin','staff','volunteer','doctor']
  ]);

Route::get('doctor/{doctorId}',
  ['middleware' => ['jwt.auth','roles'],
  'as' =>'fetch_doctor',
  'uses' =>'DoctorController@fetchDoctor',
  'roles' => ['admin','staff','volunteer','doctor']
  ]);

/******************************/

Route::post('patient',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'registerPatient', 
   'uses' => 'PatientController@create',
   'roles' => ['admin', 'staff','volunteer']
   ]
);

Route::get('patient/{patientId}',
['middleware' => ['jwt.auth','roles'],
   'as' => 'patient', 
   'uses' => 'PatientController@show',
   'roles' => ['admin', 'staff','volunteer','doctor']
   ]
);

Route::get('patients',
['middleware' => ['jwt.auth','roles'],
   'as' => 'fetch_patient', 
   'uses' => 'PatientController@fetchPatients',
   'roles' => ['admin', 'staff']
   ]
);

Route::get('volunteer/patients/{eventId}',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'fetchPatients', 
   'uses' => 'VolunteerController@fetchPatients',
   'roles' => ['volunteer']
  ]
);

Route::get('doctor/patients',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'fetchPatients', 
   'uses' => 'DoctorController@fetchPatients',
   'roles' => ['doctor']
  ]
);

Route::post('diagnosisResponses',
   ['middleware' => ['jwt.auth','roles'],
   'as' => 'saveDiagnosisResponses', 
   'uses' => 'DiagnosisController@saveDiagnosisResponses',
   'roles' => ['admin', 'staff','volunteer']
   ]);

Route::get('diagnosisResponses/{screeningId}',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'fetchDiagnosisResponse', 
   'uses' => 'DiagnosisController@fetchDiagnosisResponses',
   'roles' => ['admin', 'staff','volunteer','doctor']
   ]
  );

Route::post('diagnosisImage/{screeningId}',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'saveDiagnosisImage', 
   'uses' => 'DiagnosisController@saveImage',
   'roles' => ['volunteer','admin','staff']
  ]
);

Route::get('diagnosisImage/{screeningId}/{imageName}', 
  ['as' => 'diagnosisImage',
   'uses'=> 'DiagnosisController@fetchImage'
  ]);

Route::get('diagnosisImages/{screeningId}',
  ['as' => 'diagnosisImages',
   'uses' => 'DiagnosisController@fetchImagesForScreening'
  ]);

// Rating

Route::post('rating',
  ['middleware' => ['jwt.auth','roles'],
   'as' => 'rate_user', 
   'uses' => 'RatingController@create',
   'roles' => ['admin', 'staff','volunteer','doctor']
  ]);
