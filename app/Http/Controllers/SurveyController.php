<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\User;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Questionnaire $questionnaire, $slug)
    {
        $user = User::with('response')->where('id', auth()->user()->id)->first();
       // dd($user->response);
        if ($user->response->isEmpty()){
           // dd('not voted');
            $questionnaire->load('questions.answers');
            return view('survey.show', compact('questionnaire'));
        } else{
           // dd('voted');
            return redirect()->back()->withErrors(['You already have voted!']);
        }
    }

    public function store(Request $request, Questionnaire $questionnaire)
    {
        $validated = $request->validate(
            [
                'responses.*.answer_id' => 'required',
                'responses.*.question_id' => 'required',
                'survey.email' => 'required|email',
                'survey.name' => 'required',
            ]
        );
        $survey = $questionnaire->surveys()->create($validated['survey']);
        $survey->responses()->createMany($validated['responses']);

        $user = SurveyResponse::with('survey')->where('survey_id', $survey->id)->get();

        foreach ($user as $usr) {
            $usr->user_id = auth()->user()->id;
            $usr->save();
        }
        return view('questionnaire.show', compact('questionnaire'));
    }
}
