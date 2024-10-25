<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class ProductManagerNotification extends Notification  implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public string $message;
    public $storeproduct;
    public $status;

       public function __construct($storeproduct)
       {
           $this->storeproduct = $storeproduct;
           $this->message =  "Product " 
          . $storeproduct->quantity . ' with id: '
          . $storeproduct->id . ' is '
           . ($storeproduct->status == 'lowStock' ? 'on low stock' : ($this->storeproduct->status == 'outOfStock' ? 'Out of Stock!' : '[Error]'));
   
       }

       public function via(object $notifiable): array
    {
        
        return ['mail', 'broadcast', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->message)
            ->action('View Product', url('/store/' . $this->storeproduct->store_id . '/product/' . $this->storeproduct->id));
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->message
        ]);
    }

  

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'product' => $this->storeproduct,
        ];
    }
}