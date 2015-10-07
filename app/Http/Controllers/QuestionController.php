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

use DB;

class QuestionController extends Controller
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
     * Creates a cancer type.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCancerType(Request $request) {
        $cancerType['name'] = $request->input('name');
        $cancerType['description'] = $request->input('description');
        try {
            $result = CancerType::create($cancerType);

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not save cancer type'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
                    return json_encode(['cancerType' =>$result]);

    }

    public function getCancerTypes() {
        $result = CancerType::all();
        return json_encode(['cancerTypes'=>$result]);
    }

    public function createSection(Request $request) {
        $section['name'] = $request->input('name');
        $section['description'] = $request->input('description');
        try {
            $result = Section::create($section);

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not save cancer type'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        return json_encode(['section' =>$result]);
    }

    public function getSections() {
        $result = Section::all();
        return json_encode(['sections'=>$result]);
    }

    public function addQuestion(Request $request) {
        $question['title'] = $request->input('title');
        $question['sectionId'] = $request->input('sectionId');
        try {
            $result = Question::create($question);

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not save question'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        return json_encode(['question' =>$result]);
    }

    public function getQuestions($sectionId=null,$keyword=null) {
        $result = Question::like('title', $keyword)->where('sectionId',$sectionId)->get();
        return json_encode(['questions' =>$result]);
    }


    public function addOptionGroup(Request $request) {
        $optionGroup['name'] = $request->input('name');
        $optionGroup['sectionId'] = $request->input('sectionId');
        try {
            $result = OptionGroup::create($optionGroup);

        }catch(\Exception $e) {
            return response()->json([
                'error' => [
                    'message' => 'Could not save optionGroup'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
        }
        return json_encode(['optionGroup' =>$result]);

    }

    public function getOptionGroups($sectionId=null) {
        $result = DB::table('option_groups')->where('sectionId', $sectionId)->get();
        return json_encode(['optionGroups' =>$result]);
    }

    public function addOptions($groupId,Request $request) {
        $list = $request->input('options');
        var_dump($list);
        $optionData = array();

        foreach ($list as $option) {
            $option['groupId'] = $groupId;
            $optionData[] = $option;
        }
        try {
               $result = Option::insert($optionData);

             }catch(\Exception $e) {
                   return response()->json([
                  'error' => [
                      'message' => 'Could not save options'.$e->getMessage(),
                    'code' => 101,
                    ]
                 ]);
            }
        return json_encode(['result' =>$result]);
    }

    public function getOptions($groupId) {
        $result = DB::table('options')->where('groupId', $groupId)->get();
        return json_encode(['options' =>$result]);
    }
    public function removeOption($optionId) {

    }

    public function removeAllOptions($groupId) {

    }
    public function addOption($groupId,Request $request) {

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
