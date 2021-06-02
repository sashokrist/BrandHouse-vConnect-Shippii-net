<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $poll = Poll::with('answer')->latest()->first();
       // dd($poll);
        return view('poll.index' , compact('poll'));
    }

    public function create()
    {
        return view('poll.create');
    }

    public function store(Request $request)
    {
       // dd($request->all());
        $poll = new Poll();
        $poll->title = $request->question;
        $poll->save();

        $pollAnswer = Poll::latest()->first();
        foreach($request->answers as $res){
            $result = new PollResult();
            $result->poll_id = $pollAnswer->id;
            $result->answer = $res;
            $result->save();
        }
        return redirect()->route('event/index')->with('success','New event was created successfully!');
    }
}
