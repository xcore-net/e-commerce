<?php

// namespace App\Events;

//    use Illuminate\Broadcasting\Channel;
//    use Illuminate\Broadcasting\InteractsWithSockets;
//    use Illuminate\Broadcasting\PrivateChannel;
//    use Illuminate\Broadcasting\PresenceChannel;
//    use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
//    use Illuminate\Foundation\Events\Dispatchable;
//    use Illuminate\Queue\SerializesModels;

//    class outOfStock implements ShouldBroadcastNow
//    {
//        use Dispatchable, InteractsWithSockets, SerializesModels;

//        public $message;

//        public function __construct($message)
//        {
//            $this->message = "status:outOfStock";
//        }

//        public function broadcastOn()
//        {
//            return new Channel('channel2');
//        }

//        public function broadcastAs()
//        {
//            return "myevent2";
//        }
//    }