<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('chatroom', function () { return true; });

// Broadcast::channel('users', function() {return true;});

// Broadcast::channel('chating', function() {return true;});

// // Broadcast::channel('records', function() {return true;});

// Broadcast::channel('ersal.{mobile}', function() {
//     return true;
// });

Broadcast::channel('daryaft-payam.{id1}.{id2}', function($user, $id1, $id2) {

    return in_array($user->id, [(int)$id1, (int)$id2]);

});
