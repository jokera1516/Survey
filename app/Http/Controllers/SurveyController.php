<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys=Survey::all();
        return view('welcome',compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addSurvey');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'question' => 'required',
            'answers.*' => 'required',
        ]);

        $survey=new Survey();
        $survey->question=$request->question;
        $survey->save();

        $answers=$request->answers;

        foreach ($answers as $answerInput){

            $answer=new Answer();
            $answer->name=$answerInput;
            $survey->answers()->save($answer);

        }
        return redirect('/survey');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey=Survey::find($id);
        return view('oneSurvey',compact('survey'));
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
    public function vote($id,Request $request)
    {
        if(Cookie::get('answered')){
            $old_value = Cookie::get('answered');
            $cookie =  Cookie::make('answered', $old_value.','.$id);
        }
        else{
            $cookie =  Cookie::make('answered', $id);
        }


        $survey=Survey::find($id);
        $survey->totalVotes=$survey->totalVotes+1;
        $survey->save();
        $answer=Answer::find($request->answer);
        $answer->votes=$answer->votes+1;
        $answer->save();
        return redirect('/survey')->withCookie($cookie);
    }
}
