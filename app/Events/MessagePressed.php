<?php

namespace Chatmimik\Events;

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