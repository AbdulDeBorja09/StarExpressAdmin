<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Broadcasting\Channel;

class NewOrderNotification extends Notification
{
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_reference' => $this->order->reference_number,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'order_reference' => $this->order->reference_number,
        ]);
    }

    public function broadcastOn()
    {
        return new Channel('new-order-channel');
    }

    public function broadcastAs()
    {
        return 'new-order-notification';
    }
    public function id()
    {
        return Guid::uuid4()->toString();
    }
}
