<?php

namespace App\Http\Controllers;

use App\Events\VoteCreated;
use App\Events\VoteDeleted;
use App\Models\Option;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function vote(Request $request, Question $question, Option $option)
    {
        $user = $request->user();

        if (!$question->options->contains($option)) {
            return response([
                "message" => "This option does not belong to the specified question."
            ], 400);
        }

        $existingVote = Vote::where('user_id', $user->id)
            ->whereIn('option_id', $question->options->pluck('id'))
            ->first();

        if ($existingVote) {
            if ($existingVote->option_id === $option->id) {
                $existingVote = $existingVote->load(['option', 'user']);

                $option->decrement('votes_count');
                $existingVote->delete();
                broadcast(new VoteDeleted($existingVote));
                return response([
                    "message" => "Vote removed successfully"
                ]);
            }

            $existingVote->option->decrement('votes_count');
            $existingVote->delete();
        }

        $vote = Vote::create([
            "user_id" => $user->id,
            "option_id" => $option->id
        ]);

        $option->increment('votes_count');
        $vote = $vote->load(['option', 'user']);
        broadcast(new VoteCreated($vote));
        return response([
            "message" => "Vote updated successfully",
            "vote" => $vote
        ]);
    }


}
