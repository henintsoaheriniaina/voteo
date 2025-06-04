<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function vote(Request $request, Question $question, Option $option)
    {
        $vote = Vote::where('user_id', $request->user()->id)
            ->where('option_id', $option->id)
            ->first();
        if ($vote) {
            $option->votes_count = $option->votes_count - 1;
            $option->save();

            $vote->delete();
            return response([
                "message" => "Vote removed successfully"
            ]);
        } else {
            $vote = Vote::create([
                "user_id" => $request->user()->id,
                "option_id" => $option->id
            ]);
            $option->votes_count = $vote->option->votes_count + 1;
            $option->save();
            return response([
                "message" => "Vote added successfully",
                "vote" => $vote->load(['option', 'user'])
            ]);
        }

    }
}
