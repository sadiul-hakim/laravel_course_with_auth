<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('channel-name-{orderId}', function (User $user, int $orderId) {
    return true;
    // return $user->id===Order::findOrNew($orderId)->user_id;
});

Broadcast::channel('chat.{id}', function ($user, $id) {
    return true;
});
