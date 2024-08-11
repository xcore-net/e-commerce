<?php

namespace App\Events;

   use Illuminate\Broadcasting\Channel;
   use Illuminate\Broadcasting\InteractsWithSockets;
   use Illuminate\Broadcasting\PrivateChannel;
   use Illuminate\Broadcasting\PresenceChannel;
   use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
   use Illuminate\Foundation\Events\Dispatchable;
   use Illuminate\Queue\SerializesModels;

   class lowOfStock implements ShouldBroadcastNow
   {
       use Dispatchable, InteractsWithSockets, SerializesModels;

       public $message;

       public function __construct($message)
       {
           $this->message = "status:lowOfStock";
       }

       public function broadcastOn()
       {
           return new Channel('channel1');
       }

       public function broadcastAs()
       {
           return "myevent1";
       }
   }