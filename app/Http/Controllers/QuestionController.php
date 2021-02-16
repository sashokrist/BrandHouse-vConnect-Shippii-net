<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\SurveyResponse;
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
      //  dd($request->all());
        $validated = $request->validate(
            [
                'question.question' => 'required',
                'answers.*.answer' => 'required',
            ]
        );
        $question = $questionnaire->questions()->create($validated['question']);
        $question->answers()->createMany($validated['answers']);

        $files = [];
        if($request->hasfile('filenames'))
        {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'.'.$file->extension();
              //  dd($name);
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }
        $filename = json_encode($files);
dd($filename);
        $q = Question::with('answers')->first();
        foreach ($q->answers as $answer){
           // dd($answer);
           $answer->filename = $filename;
        }
        $q->save();

        return redirect('/questionnaires/' . $questionnaire->id);
        // return view('questionnaire.show', compact('questionnaire'));
    }

    public function destroy(Questionnaire $questionnaire, Question $question)
    {
            $question->answers()->delete();
            $question->delete();

            return redirect($questionnaire->path());
    }
}
