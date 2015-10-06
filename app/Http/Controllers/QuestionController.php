<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as HttpResponse;

use App\CancerType;
use App\Section;
use App\Question;

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
        try {
            $result = Question::create($question);

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

    public function getQuestions(Request $request) {
       $result = User::like('name', $request)->get();
       return json_encode(['questions' =>$result]);
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