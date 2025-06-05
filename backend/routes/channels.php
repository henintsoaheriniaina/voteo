<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('questions', function ($user) {
    return true;
});

Broadcast::channel('questions', function ($user) {
    return true;
});

Broadcast::channel('vote.{voteId}', function ($user, $voteId) {
    \Log::info('User joined vote channel', [
        'user_id' => $user->id,
        'vote_id' => $voteId
    ]);
    return true;
});

