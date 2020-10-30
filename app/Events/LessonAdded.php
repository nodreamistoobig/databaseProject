<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Schedule;
use App\Models\Group;

class LessonAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lesson;
    public $group;
	
    public function __construct(Group $group, $lesson)
    {
        $this->lesson = $lesson;
        $this->group = $group;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
