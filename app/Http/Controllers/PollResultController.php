<?php

namespace App\Http\Controllers;

use App\Models\PollResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PollResultController extends Controller
{
    public function store(Request $request)
    {
        $canVote = PollResult::where('user_id', auth()->user()->id)->where('poll_id', $request->poll_id)->first();
        if ($canVote === null) {
            foreach ($request->answer as $ans) {
                $pollResult = new PollResult();
                $pollResult->user_id = auth()->user()->id;
                $pollResult->poll_id = $request->poll_id;
                $pollResult->answer = $ans;
                $pollResult->save();
            }
        } else {
            return redirect()->back()->withErrors(['You already voted']);
        }
        $results = PollResult::with('user')->get();
        return redirect()->route('poll', compact('results'))->with('message', 'You have voted successfully!');
    }
}
