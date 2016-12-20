<?php

namespace Chatmimik\App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageKeydown extends Event implements ShouldBroadcast
{
    public $user;

    public function __construct()
    {
        
    }

    public function broadcastOn()
    {
        return ['presence-chat'];
    }
}