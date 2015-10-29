<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Rating;

class RatingController extends TokenAuthController
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $result = $this->getAuthenticatedUser();
        $value = $result->getData();
        if (property_exists($value, 'error')) {
            return $result;
        }else {
            $givenTo = $request->input('userId');
            $givenBy = $value->result->id;
            $ratingValue = $request->input('ratingValue');

            try {
                Rating::create([
                    'givenBy'     => $givenBy,
                    'givenTo'     => $givenTo,
                    'ratingValue' => $ratingValue
                ]);
            }catch(\Exception $e){
                 return response()->json([
                   'error' => [
                    'message' => 'Error while saving rating',
                    'code' => 400]]);
        }
        $finalResult['rating'] = $this->ratingForUser($givenTo);
        return response()->json(['result'=> $finalResult]);
        }
    }

    public function ratingForUser($userId) {
        $rating = Rating::where('givenTo','=', $userId)->get();
        $ratingValues = array_column($rating->toArray(),'ratingValue');
        $sum = 0;
        foreach ($ratingValues as $ratingValue) {
                $sum += $ratingValue;
        }
        $finalRating = (count($ratingValues) > 0) ? $sum/count($ratingValues) : 0;
        
        return $finalRating;
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
