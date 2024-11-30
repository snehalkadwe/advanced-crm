<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class SmsNotification extends Notification
{
    use Queueable;

    protected $smsMessage;  // SMS message content

    /**
     * Create a new notification instance.
     */
    public function __construct($smsMessage)
    {
        $this->smsMessage = $smsMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return [TwilioChannel::class]; // Specify Twilio as the delivery channel
    }

    /**
     * Send the SMS via Twilio.
     *
     * @param mixed $notifiable
     * @return TwilioSmsMessage
     */
    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())
            ->content($this->smsMessage); // Use the dynamic message
    }

    /**
     * Route notifications for Twilio.
     *
     * @param mixed $notifiable
     * @return string
     */
    public function routeNotificationForTwilio($notifiable)
    {
        return $notifiable->phone; // Ensure the `phone` is available on the notifiable
    }
}
