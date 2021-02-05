<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Questionnaire $questionnaire)
    {
        //dd($questionnaire);
        return view('question.create', compact('questionnaire'));
    }

    public function store(Request $request, Questionnaire $questionnaire)
    {
        $validated = $request->validate(
            [
                'question.question' => 'required',
                'answers.*.answer' => 'required',
            ]
        );

        $question = $questionnaire->questions()->create($validated['question']);
        $question->answers()->createMany($validated['answers']);

        return redirect('/questionnaires/' . $questionnaire->id);
        // return view('questionnaire.show', compact('questionnaire'));
    }
}
