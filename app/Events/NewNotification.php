<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function broadcastOn()
    {
        $isGlobal = $this->notification->recipient_id;

        if(!$isGlobal){
            return new Channel('notification');
        }else{
            return new Channel("notification.$isGlobal");
        }
    }

    public function broadcastAs()
    {
        return 'event';
    }

    public function broadcastWith()
    {
        return [
            'notification' => $this->notification,
            'causer' => Auth::user(),
        ];
    }
}
