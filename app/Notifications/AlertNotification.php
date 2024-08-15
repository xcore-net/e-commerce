<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlertNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public string $message;
    public $productCollection;
    public $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($productCollection)
    {
        $this->productCollection = $productCollection;
        $this->message =  "Product "
            . $productCollection->get('product')->title . ' with id: '
            . $productCollection->get('storeProduct_id') . ' is '
            . ($productCollection->get('status') == 'LowStock' ? 'on low stock' : ($this->productCollection->get('status') == 'OutOfStock' ? 'Out of Stock!' : '[Error]'));
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'broadcast', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->message)
            ->action('View Product', url('/store/' . $this->productCollection->get('store_id') . '/product/' . $this->productCollection->get('storeProduct_id')));
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->message
        ]);
    }

    public function broadcastas()
    {
        return 'notification';
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
            'productCollection' => $this->productCollection,
        ];
    }
}
