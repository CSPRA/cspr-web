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
            // var_dump($questions);
        $optionGroups = array_filter(array_unique((array_column($questions, 'optionGroupId'))),'strlen');
        $options = DB::table('options')
                    ->select('id','name','groupId')
                    ->whereIn('groupId', $optionGroups)->orderBy('id', 'groupId')->get();

                    // var_dump($options);
            return  $this->organize($questions,$options);

    }

    public function organize($questions,$options) {
        $sections = array_unique((array_column($questions, 'sectionId')));
        $finalResult = array();
        foreach ($sections as $key => $value) {
            $section['sectionId'] = $value;
            $questionsForSection = array_filter($questions, function($v) use($value){
             return $v['sectionId'] == $value; 
            });
            $children = $this->getNestedQuestionForParent($questionsForSection,$options,null);
            $section['questions'] = $children['questions'];
            $finalResult[] = $section;
        }

        return array('section'=>$finalResult);
    }

    public function getNestedQuestionForParent($tree,$options,$parentId) {

        $questions = array_filter($tree, function($v) use($parentId){
            return $v['parentQueryId'] == $parentId; 
        });
        $array = array();
        foreach ($questions as $row) {
            $finalObject['questionId'] = $row['questionId'];
            $finalObject['title'] = $row['title'];
            $finalObject['type'] = $row['questionType'];
            $finalObject['order'] = $row['order'];
            $finalObject['units'] = $row['units'];
            $currentGroupId = $row['optionGroupId'];
            $selectedOptions = array();
        
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
 public function organisePerSection($list) {
        $sections = array_unique((array_column($list, 'sectionId')));
        $finalResult = array();
        foreach ($sections as $key => $value) {
            $section['sectionId'] = $value;
            $children = $this->getChildrenForParent($list,null,$value);
            $section['questions'] = $children['questions'];
            $finalResult[] = $section;
        }

    }
    public function getChildrenForParent($tree,$parentId,$sectionId) {
       static  $finalResult = array();
        $questions = array_filter($tree, function($v) use($parentId,$sectionId){
            return $v['parentId'] == $parentId && $v['sectionId'] == $sectionId; 
        });
        $array = array();
        foreach ($questions as $row) {
            //Process questions
            $finalObject['id'] = $row['questionId'];
            // if ($row['hasChildren'] == true) {
            $children= $this->getChildrenForParent($tree,$row['questionId'],$sectionId);
            $finalObject['questions'] = $children['questions'];
            $array[] = $finalObject;
        }
         
        // var_dump($res);
        return array('questions'=>$array);
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
