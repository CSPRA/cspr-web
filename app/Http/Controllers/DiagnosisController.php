<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response as HttpResponse;

use App\CancerType;
use App\Section;
use App\Question;
use App\OptionGroup;
use App\Option;
use App\DetectionForm;
use App\Query;
use App\Response;
use App\Screening;
use App\Event;
use App\Assignment;
use App\DiagnosisImage;

use DB;
use Storage;
use File;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
    * Create a cancer detection form
    *
    */

    public function createDetectionForm(Request $request) {
        $detectionForm['name'] = $request->input('name');
        $detectionForm['description'] = $request->input('description');
        $detectionForm['cancerId'] = $request->input('cancerId');
        $detectionForm['createdBy'] = $request->input('createdBy');
        try {
            $result = DetectionForm::create($detectionForm);

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not create cancer detection form'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        return response()->json(['result' =>$result]);
    }

    public function addQueryToDetectionForm($formId,Request $request) {
        $query = new Query;
        $query->formId = $formId;
        $query->sectionId = $request['sectionId'];
        $query->questionId = $request['questionId'];
        $query->questionType = $request['questionType'];
        $query->optionGroupId = $request['optionGroupId'];
        $query->order = $request['order'];
        $query->units = $request['units'];
        $query->parentQueryId = $request['parentQueryId'];

        try {
            $query->save();
        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not create query'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        response()->json(['result' =>$query]);
    }


    public function fetchQueryForDetectionForm($formId) {
        $questions = DB::table('query')
            ->join('sections', 'sections.id', '=', 'query.sectionId')
            ->join('questions', 'questions.id', '=', 'query.questionId')
            ->select('query.*', 'sections.name as sectionName', 'questions.title')
            ->where('formId','=',$formId)
            ->get();
        $optionGroups = array_filter(array_unique((array_column($questions, 'optionGroupId'))),'strlen');
        $options = DB::table('options')
                    ->select('id','name','groupId','order')
                    ->whereIn('groupId', $optionGroups)->orderBy('order','groupId')->get();
            return  $this->organize($questions,$options);
    }

    public function organize($questions,$options) {
        $sections = array_unique((array_column($questions, 'sectionId')));
        $finalResult = array();
        sort($sections);
        foreach ($sections as $key => $value) {
            $section['sectionId'] = $value;
            $questionsForSection = array_filter($questions, function($v) use($value){
             return $v['sectionId'] == $value; 
            });
            $section['sectionName'] = reset($questionsForSection)['sectionName'];
            $children = $this->getNestedQuestionForParent($questionsForSection,$options,null);
            $section['questions'] = $children['questions'];
            $finalResult[] = $section;
        }
        return response()->json(['sections' =>$finalResult]);
    }

    public function getNestedQuestionForParent($tree,$options,$parentId) {

        $questions = array_filter($tree, function($v) use($parentId){
            return $v['parentQueryId'] == $parentId; 
        });
        $array = array();
        foreach ($questions as $row) {
            $finalObject['queryId'] = $row['id'];
            $finalObject['questionId'] = $row['questionId'];
            $finalObject['title'] = $row['title'];
            $finalObject['type'] = $row['questionType'];
            $finalObject['order'] = $row['order'];
            $finalObject['units'] = $row['units'];
            $currentGroupId = $row['optionGroupId'];
            $selectedOptions = array();
            
            asort($options);

            foreach ($options as $key => $value) {
                if ($value['groupId'] == $currentGroupId) {
                    $selectedOptions[]= $value;
                }
            }

            $finalObject['options'] = $selectedOptions;
            $children = $this->getNestedQuestionForParent($tree,$options,$row['id']);
            $finalObject['questions'] = $children['questions'];
            $array[] = $finalObject;
        }
         
        
        return array('questions'=>$array);
    }

    public function saveDiagnosisResponses(Request $request) {
        try {
            $screening = new Screening();
            $screening['eventId'] = $request->input('eventId');
            $screening['patientId'] = $request->input('patientId');
            $screening['volunteerId'] = $request->input('volunteerId');

            $screening->save();

        }catch(\Exception $e) {
            return response()->json([
            'error' => [
                'message' => 'Could not save screening'.$e->getMessage(),
                'code' => 101,
                ]
             ]); 
        }
        $responses = $request->input('responses');
        $responseToSave = array();
        foreach ($responses as $inputResponse) {
            $response['screeningId'] = $screening['id'];
            $response['queryId'] = $inputResponse['queryId'];
            if (array_key_exists('textAnswer',$inputResponse)) {
                $response['textAnswer'] = $inputResponse['textAnswer'];
            }
            if (array_key_exists('numberAnswer',$inputResponse)) {
                $response['numberAnswer'] = $inputResponse['numberAnswer'];
            }
            if (array_key_exists('boolAnswer', $inputResponse)) {
                $response['boolAnswer'] = $inputResponse['boolAnswer'];
            }
            if (array_key_exists('optionGroupId', $inputResponse)) {
                $response['optionGroupId'] = $inputResponse['optionGroupId'];
            }
            if (array_key_exists('optionId', $inputResponse)) {
                $response['optionId'] = $inputResponse['optionId'];
            }
            $responseToSave[] = $response;
        }
        try {
            DB::table('response')->insert($responseToSave);
        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not save responses'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        return response()->json(['result' =>'success']);
    }


    public function fetchDiagnosisResponses($screeningId) {
        $responses = DB::table('response')
                  ->join('query','query.id', '=', 'response.queryId')
                  ->select('query.*','response.*')
                  ->get();
        if (count($responses) > 0) { 
            $formId = $responses[0]['formId'];
        }

        $queries = $this->fetchQueryForDetectionForm($formId)->getData();
        $finalResult = array();
        $sections = $queries->sections;
        foreach ($sections as $section) {
            $finalSection['sectionId'] = $section->sectionId;
            $finalSection['sectionName'] = $section->sectionName;
            $children = $this->getNestedResponseForParent($section->questions,null,$responses);
            $finalSection['responses'] = $children['responses'];
            $finalResult['sections'][] = $finalSection;
        }
        return response()->json(['result' =>$finalResult['sections']]);
  
    }

    public function getNestedResponseForParent($questions,$parentId,$responses) {
        if ($questions == null) {
            return array('responses'=>array());
        }
         foreach ($questions as $question) {
                $responseObject['queryId'] = $question->queryId;
                $responseObject['questionId'] = $question->questionId;
                $responseObject['title'] = $question->title; 
                $responseObject['type'] = $question->type;
                $responseObject['order'] = $question->order;
                $responseObject['units'] = $question->units;
                $responseObject['options'] = $question->options;
                $queryId =  $question->queryId;
                $result = array_filter($responses, function($v) use($queryId){
                     return $v['queryId'] == $queryId; 
                    });

                $answerObject = array();
                switch ($question->type) {
                    case 'text':
                        $answer = reset($result);
                        $answerObject['answerId'] = $answer['id'];
                        $answerObject['textAnswer'] = $answer['textAnswer'];
                    break;

                    case 'number':
                        $answer = reset($result);
                        $answerObject['answerId'] = $answer['id'];
                        $answerObject['numberAnswer'] = $answer['numberAnswer'];
                    break;

                    case 'boolean':
                        $answer = reset($result);
                        $answerObject['answerId'] = $answer['id'];
                        $answerObject['boolAnswer'] = $answer['boolAnswer'];
                    break;

                    case 'single choice':
                        $answer = reset($result);
                        $answerObject['answerId'] = $answer['id'];
                        $optionId = $answer['optionId'];
                        $optionGroupId = $answer['optionGroupId'];
                        $options = array_filter($question->options, function($v) use($optionId,$optionGroupId){
                            return $v->id == $optionId && $v->groupId == $optionGroupId; 
                            });
                        $answerObject['options'] =  reset($options);                        

                        break;

                    case 'multiple choice':
                        foreach ($result as $answer) {
                            $answerObject['answerId'] = $answer['id'];
                            $optionId = $answer['optionId'];
                            $optionGroupId = $answer['optionGroupId'];
                            $options = array_filter($question->options, function($v) use($optionId,$optionGroupId){
                               return $v->id == $optionId && $v->groupId == $optionGroupId; 
                            });
                            if ($options != null) {
                                $answerObject['options'][] = reset($options);
                            }
                        }

                        break;

                    default:
                        break;
                }
                 $responseObject['answer'] = $answerObject;
                 $dependentQuestions  = $question->questions;

                 $children = $this->getNestedResponseForParent($question->questions,$queryId,$responses);
                 $responseObject['responses'] = $children['responses'];
                $finalResult[] = $responseObject;
            }
        return array('responses'=>$finalResult);

    }

   /****************** Event **************************/    

   public function createEvent(Request $request) {
     $event = new Event;
     $event->name = $request->input('name');
     $event->cancerId = $request->input('cancerId');
     $event->startDate = $request->input('startDate');
     $event->endDate = $request->input('endDate');
     $event->formId = $request->input('formId');

    try {
        $event->save();

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not create event'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        return response()->json(['result' =>$event]);
   }

   public function fetchEvents(Request $request) {
        $cancerType = $request['cancerType'];
        $query = DB::table('events')
                ->join('cancer_types', 'cancer_types.id', '=', 'events.cancerId')
                ->join('detection_form', 'detection_form.id', '=', 'events.formId')
                ->select('events.*', 'cancer_types.name as cancerName','cancer_types.id as cancerId', 'detection_form.name');

        if ($cancerType) {
            $query = $query->where('cancer_types.id','=',$cancerType);
        }
        $events = $query->orderBy('events.startDate', 'desc')->get();
        return response()->json(['result' => $this->processedEvents($events)]);
   }

   private function processedEvents($events) {
    $finalResult =  array();
    foreach ($events as $event) {
         $finalObject['id'] = $event['id'];
         $finalObject['name'] = $event['name'];
         $finalObject['startDate'] = $event['startDate'];
         $finalObject['endDate'] = $event['endDate'];
         $finalObject['eventType'] = $event['eventType'];
         $finalObject['formId'] = $event['formId'];
         $cancerType['name'] = $event['cancerName'];
         $cancerType['id'] = $event['cancerId'];
         $finalObject['cancerType'] = $cancerType;
         $finalResult[] = $finalObject;
    }
    return $finalResult;
   }

   public function fetchEvent($eventId) {
        $events = DB::table('events')
            ->join('cancer_types', 'cancer_types.id', '=', 'events.cancerId')
            ->join('detection_form', 'detection_form.id', '=', 'events.formId')
            ->select('events.*', 'cancer_types.name as cancerName', 'detection_form.name')
            ->where('events.id','=',$eventId)
            ->get();
        $event = $this->processedEvents($events)[0];
            return response()->json(['result' =>$event]);
   }

   public function assignVolunteers($eventId,Request $request) {
        $volunteers = $request->input('volunteerIds');
        $data = array();
        foreach ($volunteers as $volunteerId) {
            $data[] = array('volunteerId'=>$volunteerId,'eventId'=>$eventId);
        }
        try {
            Assignment::insert($data);

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not assign volunteers'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        return response()->json(['result' =>$data]);
   }

   public function fetchEventVolunteers($eventId,Request $request) {
        $volunteers = DB::table('screening_assignment')
            ->join('volunteers', 'volunteers.userId', '=', 'screening_assignment.volunteerId')
            ->join('users', 'users.id', '=', 'volunteers.userId')
            ->select('users.id','users.name', 'users.email','volunteers.firstName','volunteers.lastname',
                'volunteers.contactNumber')
            ->get();
            return response()->json(['result' =>$volunteers]);
   }

    public function saveImage($screeningId,Request $request) {
       $imageCount = DB::table('diagnosis_images')->where('screeningId','=',$screeningId)->count();
       $imageCount ++;
       $result =  Storage::disk('public')->put($screeningId.'/image_'.$imageCount.'.jpg',  $request->getContent());
       $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$screeningId;

       $diagnosisImage = new DiagnosisImage;
       $diagnosisImage['screeningId'] = $screeningId;
       $diagnosisImage['description'] = $request->input('description');
       $diagnosisImage['imageName'] = 'image_'.$imageCount.'.jpg';
       
       try {
        $diagnosisImage->save();

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not save image'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        return response()->json(['result' =>'success']);
    }

    public function fetchImage($screeningId,$imageName) {
        $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$screeningId;

        $path = $storagePath . '/' . $imageName;
 
       try {
        $file = File::get($path);
        $type = File::mimeType($path);

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => $e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }        
        $response = Response($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function fetchImagesForScreening($screeningId) {
      $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$screeningId;

        $result = DB::table('diagnosis_images')->where('screeningId','=',$screeningId)->get();
        $finalResult = array();
        foreach ($result as $imageInfo) {
            $info['description'] = $imageInfo['description'];
            $info['imageURL'] = url().'/diagnosisImage/'.$screeningId.'/'.$imageInfo['imageName'];
            $finalResult[] = $info;
        }
        return Response(
        str_replace('\/','/',json_encode(['result'=>$finalResult])), 200,
        ['Content-Type' => 'application/json']
    );
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
        //
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
