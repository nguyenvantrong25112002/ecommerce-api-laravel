<?php

namespace App\Events\Admin;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateGalleryProductEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public function __construct(public $gallerys, public $product_id)
    {
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}