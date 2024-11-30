<?php

namespace App\Notifications;

use Twilio\Rest\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;
use Illuminate\Notifications\Messages\MailMessage;

class SendSalesCreatedNotification extends Notification
{
    use Queueable;

    protected $saleDetails; // Sale details

    /**
     * Create a new notification instance.
     */
    public function __construct($saleDetails)
    {
        $this->saleDetails = $saleDetails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Sale Created')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new sale has been added for you.')
            ->line('Sale Details:')
            ->line('Product: ' . $this->saleDetails['product_name'])
            ->line('Amount: $' . number_format($this->saleDetails['amount'], 2))
            ->action('View Sale', url('/sales/' . $this->saleDetails['id']))
            ->line('Thank you for being a valued customer!');
    }
}
