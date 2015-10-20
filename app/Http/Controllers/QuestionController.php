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
        return response()->json(['cancerType' =>$result]);
    }

    public function getCancerTypes() {
        $result = CancerType::all();
        return response()->json(['cancerTypes' =>$result]);
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
        return response()->json(['section' =>$result]);
    }

    public function getSections() {
        $result = Section::all();
        return response()->json(['sections' =>$result]);
    }

    public function addQuestion(Request $request) {
        $question['title'] = $this->mysql_real_escape_string($request->input('title'));
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
        return response()->json(['question' =>$result]);
    }

    public function getQuestions($sectionId=null,$keyword=null) {
        $result = Question::like('title', $keyword)->where('sectionId',$sectionId)->get();
        // return str_replace('\/','/',json_encode(['questions' =>$result]));
        return response()->json(['questions' =>$result]);
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
        return response()->json(['optionGroup' =>$result]);
    }

    public function getOptionGroups($sectionId=null) {
        $result = DB::table('option_groups')->where('sectionId', $sectionId)->get();
        return response()->json(['optionGroups' =>$result]);
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
        return response()->json(['result' =>$result]);

    }

    public function getOptions($groupId) {
        $result = DB::table('options')->where('groupId', $groupId)->get();
        return response()->json(['options' =>$result]);
    }

   
    public function removeOption($optionId) {

    }

    public function removeAllOptions($groupId) {

    }
    public function addOption($groupId,Request $request) {

    }
    
    public function destroy($id)
    {
        //
    }
}
