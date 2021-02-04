<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*    public function index()
        {
            $poll = Questionnaire::latest()->first();
            return view('questionnaire.show', compact('poll'));
        }*/

    public function create()
    {
        return view('questionnaire.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|min:3',
                'purpose' => 'required',
            ]
        );

        $questionnaire = auth()->user()->questionnaries()->create($validated);
        ///dd($questionnaire->id);

        return redirect('/questionnaires/' . $questionnaire->id);
        //return view('questionnaire.show', compact('questionnaire'));
    }

    public function show(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers');
        // dd($questionnaire);
        return view('questionnaire.show', compact('questionnaire'));
    }
}
