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

use DB;

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
        return json_encode(['result' =>$result]);
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
        return json_encode(['result' =>$query]);
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
            $children = $this->getNestedQuestionForParent($questionsForSection,$options,null);
            $section['questions'] = $children['questions'];
            $finalResult[] = $section;
        }

        return array('sections'=>$finalResult);
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
            $children= $this->getNestedQuestionForParent($tree,$options,$row['id']);
            $finalObject['questions'] = $children['questions'];
            $array[] = $finalObject;
        }
         
        
        return array('questions'=>$array);
    }

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
        return json_encode(['result' =>$event]);
   }

   public function fetchEvents(Request $request) {
        $events = DB::table('events')
            ->join('cancer_types', 'cancer_types.id', '=', 'events.cancerId')
            ->join('detection_form', 'detection_form.id', '=', 'events.formId')
            ->select('events.*', 'cancer_types.name as cancerName', 'detection_form.name')
            ->get();
            return json_encode(['result' => $events]);
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
        return json_encode(['result' =>$data]);
   }

   public function fetchEventVolunteers($eventId,Request $request) {
        $volunteers = DB::table('screening_assignment')
            ->join('volunteers', 'volunteers.userId', '=', 'screening_assignment.volunteerId')
            ->join('users', 'users.id', '=', 'volunteers.userId')
            ->select('users.id','users.name', 'users.email','volunteers.firstName','volunteers.lastname',
                'volunteers.contactNumber')
            ->get();
            return json_encode(['result' => $volunteers]);
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
