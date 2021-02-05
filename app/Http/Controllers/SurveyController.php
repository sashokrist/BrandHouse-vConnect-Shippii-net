<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Questionnaire $questionnaire, $slug)
    {
        $questionnaire->load('questions.answers');
        return view('survey.show', compact('questionnaire'));
    }

    public function store(Request $request, Questionnaire $questionnaire)
    {
        $validated = $request->validate(
            [
                'responses.*.answer_id' => 'required',
                'responses.*.question_id' => 'required',
                'survey.email' => 'required|email',
                'survey.name' => 'required'
            ]
        );
       // dd($request->all());
        $survey = $questionnaire->surveys()->create($validated['survey']);
        $survey->responses()->createMany($validated['responses']);

        return 'Thank you';

    }
}
