<?php

namespace NotificationChannels\Fcm;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging;

class Channel
{
    /**
     * @var \Kreait\Firebase\Messaging
     */
    protected $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Send the given notification.
     *
     * @param mixed                                   $notifiable
     * @param Notifications\Notification|Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $notification instanceof Notifications\Notification) {
            return;
        }

        $message = $notification->toFcm($notifiable);

        if (\is_null($notifiable->routeNotificationFor('fcm', $notification))
            || ! $message instanceof Message) {
            return;
        }

        $this->messaging->send($message->toArray());
    }
}
