<?php

namespace App\Events;

use App\Events\SalesEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Notifications\SendSalesCreatedNotification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SaleCreatedListner
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
    public function handle(SalesEvent $event)
    {
        $sale = $event->sale;
        $customer = $sale->customer;
        $customer->notify(new SendSalesCreatedNotification());
    }
}
