<?php

namespace Chatmimik\Events;

use Chatmimik\Domains\Messages\Message as MessageModel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessagePublished extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MessageModel $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['presence-chat'];
    }
}
