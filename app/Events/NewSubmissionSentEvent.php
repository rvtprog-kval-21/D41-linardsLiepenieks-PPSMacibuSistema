<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewSubmissionSentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $exercise;
    public $submission;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($submission, $exercise, $user)
    {
        $this->submission = $submission;
        $this->exercise = $exercise;
        $this->user = $user;
    }


}
